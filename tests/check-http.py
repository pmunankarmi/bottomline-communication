"""Local disposable-site HTTP tests. Requires BL_WP_PATH and the test mail interceptor."""
import re,sys,urllib.request,urllib.parse,urllib.error,subprocess,json,os,csv,io
base=sys.argv[1] if len(sys.argv)>1 else 'http://127.0.0.1:8096'
assert base.startswith(('http://127.0.0.1:', 'http://localhost:')), 'Local test environment only'
def request(path,data=None,cookies=None):
    headers={'Cookie': '; '.join(k+'='+v for k,v in cookies.items())} if cookies else {}
    req=urllib.request.Request(base+path,urllib.parse.urlencode(data).encode() if data is not None else None,headers)
    try:
        with urllib.request.urlopen(req) as r:return r.status,r.read().decode('utf-8-sig'),r.url
    except urllib.error.HTTPError as e:return e.code,e.read().decode('utf-8-sig'),e.url
for path in ['/?test=1','/about/','/projects/','/clients/','/contact/']:
    status,body,url=request(path)
    assert status==200 and 'Fatal error' not in body,path
    assert body.count('<nav id="nav">')==1 and body.count('<footer>')==1,path
    print('PASS',path)
assert request('/projects.html')[2]==base+'/projects/'
html=request('/contact/')[1]
nonce=re.search(r'name="bl_nonce" value="([^"]+)"',html)[1]
def post(**overrides):
    data={'action':'bl_brief','bl_nonce':nonce,'name':'=SUM(1,2)','email':'qa@example.test','service[]':'Branding','message':'SIMULATE_FAILURE','budget':'50k – 150k','company':'Local test only'}
    data.update(overrides)
    return request('/wp-admin/admin-post.php',data)
assert post(bl_nonce='invalid')[0]==403
assert post(email='invalid')[0]==400
assert post(website='spam')[0]==400
status,body,url=post()
assert status==200 and '?brief=' in url and 'form-success show' in body
assert re.search(r'id="briefForm"[^>]*\bhidden\b',body)
assert post(message='Repeat test')[0]==429
print('PASS validation, nonce, honeypot, persistent receipt despite mail failure and rate limiting')
assert request('/wp-admin/admin-post.php',{'action':'bl_export_submissions'})[0]>=400
assert os.environ.get('BL_WP_PATH'), 'Set BL_WP_PATH for authenticated export checks'
def auth(role):
    output=subprocess.check_output(['php','-d','error_reporting=22527',os.path.join(os.path.dirname(__file__),'http-auth.php'),role],env=os.environ,text=True)
    return json.loads(output)
subscriber=auth('subscriber')
assert request('/wp-admin/admin-post.php',{'action':'bl_export_submissions','_wpnonce':subscriber['nonce']},subscriber['cookies'])[0]==403
admin=auth('administrator')
assert request('/wp-admin/admin-post.php',{'action':'bl_export_submissions','_wpnonce':'bad'},admin['cookies'])[0]==403
status,body,_=request('/wp-admin/admin.php?page=bottomline-submissions',cookies=admin['cookies'])
assert status==200 and 'Export CSV' in body and 'Failed — brief saved' in body
status,body,_=request('/wp-admin/admin-post.php',{'action':'bl_export_submissions','_wpnonce':admin['nonce']},admin['cookies'])
assert status==200
rows=list(csv.reader(io.StringIO(body)))
assert rows[0][0:3]==['ID','Date','Name']
assert any(row[2]=="'=SUM(1,2)" and row[-1]=='Failed — brief saved' for row in rows[1:])
print('PASS admin list, CSV download, failed-mail record, formula escaping, permission and CSRF enforcement')
