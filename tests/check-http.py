"""Run against a disposable local WordPress site with mail intercepted; never production."""
import re,sys,urllib.request,urllib.parse,urllib.error
base=sys.argv[1] if len(sys.argv)>1 else 'http://127.0.0.1:8096'
assert base.startswith(('http://127.0.0.1:', 'http://localhost:')), 'Local test environment only'
def get(path):
    with urllib.request.urlopen(base+path) as r:return r.status,r.read().decode(),r.url
for path in ['/?test=1','/about/','/projects/','/clients/','/contact/']:
    status,body,url=get(path)
    assert status==200 and 'Fatal error' not in body,path
    assert 'wp-content/themes/bottomline-communication' in body,path
    print('PASS',path)
assert get('/projects.html')[2]==base+'/projects/'
html=get('/contact/')[1]
nonce=re.search(r'name="bl_nonce" value="([^"]+)"',html)[1]
def post(**overrides):
    data={'action':'bl_brief','bl_nonce':nonce,'name':'Local test','email':'qa@example.test','service[]':'Branding','message':'SIMULATE_FAILURE','budget':'50k – 150k','company':'Local test only'}
    data.update(overrides)
    try:
        r=urllib.request.urlopen(base+'/wp-admin/admin-post.php',urllib.parse.urlencode(data).encode());return r.status,r.read().decode(),r.url
    except urllib.error.HTTPError as e:return e.code,e.read().decode(),e.url
assert post(bl_nonce='invalid')[0]==403
assert post(email='invalid')[0]==400
assert post(website='spam')[0]==400
assert post()[0]==503
status,body,url=post(message='Local intercepted successful test')
assert status==200 and '?brief=' in url and 'form-success show' in body
assert 'id="briefForm" hidden' in body
assert post(message='Repeat test')[0]==429
print('PASS legacy URL redirect, invalid nonce, validation, spam trap, mail failure, successful receipt, rate limit')
