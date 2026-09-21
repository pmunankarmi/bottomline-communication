

<?php get_template_part( 'template-parts/navigation-clients' ); ?>

<section class="page-hero">
  <div class="page-hero-inner">
    <span class="page-eyebrow"><?php echo esc_html( bl_value('bl_clients_001', 'Our Clients', get_queried_object_id()) ); ?></span>
    <h1><?php echo esc_html( bl_value('bl_clients_002', 'Sixty brands.', get_queried_object_id()) ); ?> <span class="accent"><?php echo esc_html( bl_value('bl_clients_003', 'One creative partner.', get_queried_object_id()) ); ?></span></h1>
    <p><?php echo esc_html( bl_value('bl_clients_004', 'From global enterprises to government bodies and ambitious regional brands — we\'ve partnered with the businesses shaping KSA and the wider MENA region.', get_queried_object_id()) ); ?></p>
  </div>
</section>

<section class="sectors">
  <div class="container">

    <div class="sector reveal">
      <div class="sector-head">
        <h2><?php echo esc_html( bl_value('bl_clients_005', 'Government & Enterprise', get_queried_object_id()) ); ?></h2>
        <span class="count"><?php echo esc_html( bl_value('bl_clients_006', '10 clients', get_queried_object_id()) ); ?></span>
      </div>
      <div class="sector-grid row row-cols-2 row-cols-md-3 row-cols-lg-5 g-0">
        <div class="col"><div class="c-cell"><img src="<?php echo esc_url( bl_url( bl_value('bl_clients_007', 'clients/saudi-aramco.png', get_queried_object_id()) ) ); ?>" alt="<?php echo esc_attr( bl_value('bl_clients_008', 'Saudi Aramco', get_queried_object_id()) ); ?>"></div></div>
        <div class="col"><div class="c-cell"><img src="<?php echo esc_url( bl_url( bl_value('bl_clients_009', 'clients/sme-bank.png', get_queried_object_id()) ) ); ?>" alt="<?php echo esc_attr( bl_value('bl_clients_010', 'SME Bank', get_queried_object_id()) ); ?>"></div></div>
        <div class="col"><div class="c-cell"><img src="<?php echo esc_url( bl_url( bl_value('bl_clients_011', 'clients/ministry-of-health.png', get_queried_object_id()) ) ); ?>" alt="<?php echo esc_attr( bl_value('bl_clients_012', 'Ministry of Health', get_queried_object_id()) ); ?>"></div></div>
        <div class="col"><div class="c-cell"><img src="<?php echo esc_url( bl_url( bl_value('bl_clients_013', 'clients/mbsc.png', get_queried_object_id()) ) ); ?>" alt="<?php echo esc_attr( bl_value('bl_clients_014', 'MBSC', get_queried_object_id()) ); ?>"></div></div>
        <div class="col"><div class="c-cell"><img src="<?php echo esc_url( bl_url( bl_value('bl_clients_015', 'clients/go-telecom.png', get_queried_object_id()) ) ); ?>" alt="<?php echo esc_attr( bl_value('bl_clients_016', 'GO Telecom', get_queried_object_id()) ); ?>"></div></div>
        <div class="col"><div class="c-cell"><img src="<?php echo esc_url( bl_url( bl_value('bl_clients_017', 'clients/boston-scientific.png', get_queried_object_id()) ) ); ?>" alt="<?php echo esc_attr( bl_value('bl_clients_018', 'Boston Scientific', get_queried_object_id()) ); ?>"></div></div>
        <div class="col"><div class="c-cell"><img src="<?php echo esc_url( bl_url( bl_value('bl_clients_019', 'clients/sarcc.png', get_queried_object_id()) ) ); ?>" alt="<?php echo esc_attr( bl_value('bl_clients_020', 'SARCC', get_queried_object_id()) ); ?>"></div></div>
        <div class="col"><div class="c-cell"><img src="<?php echo esc_url( bl_url( bl_value('bl_clients_021', 'clients/alkhorayef.png', get_queried_object_id()) ) ); ?>" alt="<?php echo esc_attr( bl_value('bl_clients_022', 'Al Khorayef', get_queried_object_id()) ); ?>"></div></div>
        <div class="col"><div class="c-cell"><img src="<?php echo esc_url( bl_url( bl_value('bl_clients_023', 'clients/rawasy-investment.png', get_queried_object_id()) ) ); ?>" alt="<?php echo esc_attr( bl_value('bl_clients_024', 'Rawasy Investment', get_queried_object_id()) ); ?>"></div></div>
        <div class="col"><div class="c-cell"><img src="<?php echo esc_url( bl_url( bl_value('bl_clients_025', 'clients/altamayyuz.png', get_queried_object_id()) ) ); ?>" alt="<?php echo esc_attr( bl_value('bl_clients_026', 'Altamayyuz', get_queried_object_id()) ); ?>"></div></div>
      </div>
    </div>

    <div class="sector reveal">
      <div class="sector-head">
        <h2><?php echo esc_html( bl_value('bl_clients_027', 'Sports & Lifestyle', get_queried_object_id()) ); ?></h2>
        <span class="count"><?php echo esc_html( bl_value('bl_clients_028', '5 clients', get_queried_object_id()) ); ?></span>
      </div>
      <div class="sector-grid row row-cols-2 row-cols-md-3 row-cols-lg-5 g-0">
        <div class="col"><div class="c-cell"><img src="<?php echo esc_url( bl_url( bl_value('bl_clients_029', 'clients/sela.png', get_queried_object_id()) ) ); ?>" alt="<?php echo esc_attr( bl_value('bl_clients_030', 'Sela', get_queried_object_id()) ); ?>"></div></div>
        <div class="col"><div class="c-cell"><?php echo esc_html( bl_value('bl_clients_031', 'UFC', get_queried_object_id()) ); ?></div></div>
        <div class="col"><div class="c-cell"><?php echo esc_html( bl_value('bl_clients_032', 'CR7', get_queried_object_id()) ); ?></div></div>
        <div class="col"><div class="c-cell"><?php echo esc_html( bl_value('bl_clients_033', 'Ring of Fire', get_queried_object_id()) ); ?></div></div>
        <div class="col"><div class="c-cell"><?php echo esc_html( bl_value('bl_clients_034', '5 vs 5', get_queried_object_id()) ); ?></div></div>
      </div>
    </div>

    <div class="sector reveal">
      <div class="sector-head">
        <h2><?php echo esc_html( bl_value('bl_clients_035', 'Automotive', get_queried_object_id()) ); ?></h2>
        <span class="count"><?php echo esc_html( bl_value('bl_clients_028', '5 clients', get_queried_object_id()) ); ?></span>
      </div>
      <div class="sector-grid row row-cols-2 row-cols-md-3 row-cols-lg-5 g-0">
        <div class="col"><div class="c-cell"><img src="<?php echo esc_url( bl_url( bl_value('bl_clients_036', 'clients/bmw.png', get_queried_object_id()) ) ); ?>" alt="<?php echo esc_attr( bl_value('bl_clients_037', 'BMW', get_queried_object_id()) ); ?>"></div></div>
        <div class="col"><div class="c-cell"><img src="<?php echo esc_url( bl_url( bl_value('bl_clients_038', 'clients/ford.png', get_queried_object_id()) ) ); ?>" alt="<?php echo esc_attr( bl_value('bl_clients_039', 'Ford', get_queried_object_id()) ); ?>"></div></div>
        <div class="col"><div class="c-cell"><img src="<?php echo esc_url( bl_url( bl_value('bl_clients_040', 'clients/mini.png', get_queried_object_id()) ) ); ?>" alt="<?php echo esc_attr( bl_value('bl_clients_041', 'MINI Cooper', get_queried_object_id()) ); ?>"></div></div>
        <div class="col"><div class="c-cell"><img src="<?php echo esc_url( bl_url( bl_value('bl_clients_042', 'clients/naghi-motors.png', get_queried_object_id()) ) ); ?>" alt="<?php echo esc_attr( bl_value('bl_clients_043', 'Naghi Motors', get_queried_object_id()) ); ?>"></div></div>
        <div class="col"><div class="c-cell"><img src="<?php echo esc_url( bl_url( bl_value('bl_clients_044', 'clients/dms.png', get_queried_object_id()) ) ); ?>" alt="<?php echo esc_attr( bl_value('bl_clients_045', 'DMS', get_queried_object_id()) ); ?>"></div></div>
      </div>
    </div>

    <div class="sector reveal">
      <div class="sector-head">
        <h2><?php echo esc_html( bl_value('bl_clients_046', 'Hospitality', get_queried_object_id()) ); ?></h2>
        <span class="count"><?php echo esc_html( bl_value('bl_clients_028', '5 clients', get_queried_object_id()) ); ?></span>
      </div>
      <div class="sector-grid row row-cols-2 row-cols-md-3 row-cols-lg-5 g-0">
        <div class="col"><div class="c-cell"><img src="<?php echo esc_url( bl_url( bl_value('bl_clients_047', 'clients/radisson-blu.png', get_queried_object_id()) ) ); ?>" alt="<?php echo esc_attr( bl_value('bl_clients_048', 'Radisson Blu', get_queried_object_id()) ); ?>"></div></div>
        <div class="col"><div class="c-cell"><img src="<?php echo esc_url( bl_url( bl_value('bl_clients_049', 'clients/crowne-plaza.png', get_queried_object_id()) ) ); ?>" alt="<?php echo esc_attr( bl_value('bl_clients_050', 'Crowne Plaza', get_queried_object_id()) ); ?>"></div></div>
        <div class="col"><div class="c-cell"><img src="<?php echo esc_url( bl_url( bl_value('bl_clients_051', 'clients/belajio.png', get_queried_object_id()) ) ); ?>" alt="<?php echo esc_attr( bl_value('bl_clients_052', 'Belajio Resort', get_queried_object_id()) ); ?>"></div></div>
        <div class="col"><div class="c-cell"><img src="<?php echo esc_url( bl_url( bl_value('bl_clients_053', 'clients/stars-avenue.png', get_queried_object_id()) ) ); ?>" alt="<?php echo esc_attr( bl_value('bl_clients_054', 'Stars Avenue', get_queried_object_id()) ); ?>"></div></div>
        <div class="col"><div class="c-cell"><?php echo esc_html( bl_value('bl_clients_055', 'Sushi Library', get_queried_object_id()) ); ?></div></div>
      </div>
    </div>

    <div class="sector reveal">
      <div class="sector-head">
        <h2><?php echo esc_html( bl_value('bl_clients_056', 'Retail & Fashion', get_queried_object_id()) ); ?></h2>
        <span class="count"><?php echo esc_html( bl_value('bl_clients_028', '5 clients', get_queried_object_id()) ); ?></span>
      </div>
      <div class="sector-grid row row-cols-2 row-cols-md-3 row-cols-lg-5 g-0">
        <div class="col"><div class="c-cell"><img src="<?php echo esc_url( bl_url( bl_value('bl_clients_057', 'clients/landmark-group.png', get_queried_object_id()) ) ); ?>" alt="<?php echo esc_attr( bl_value('bl_clients_058', 'Landmark Group', get_queried_object_id()) ); ?>"></div></div>
        <div class="col"><div class="c-cell"><?php echo esc_html( bl_value('bl_clients_059', 'Centrepoint', get_queried_object_id()) ); ?></div></div>
        <div class="col"><div class="c-cell"><img src="<?php echo esc_url( bl_url( bl_value('bl_clients_060', 'clients/sjp.png', get_queried_object_id()) ) ); ?>" alt="<?php echo esc_attr( bl_value('bl_clients_061', 'SJP', get_queried_object_id()) ); ?>"></div></div>
        <div class="col"><div class="c-cell"><?php echo esc_html( bl_value('bl_clients_062', 'Femi 9', get_queried_object_id()) ); ?></div></div>
        <div class="col"><div class="c-cell"><img src="<?php echo esc_url( bl_url( bl_value('bl_clients_063', 'clients/papabubble.png', get_queried_object_id()) ) ); ?>" alt="<?php echo esc_attr( bl_value('bl_clients_064', 'Papabubble', get_queried_object_id()) ); ?>"></div></div>
      </div>
    </div>

    <div class="sector reveal">
      <div class="sector-head">
        <h2><?php echo esc_html( bl_value('bl_clients_065', 'Food & Beverage', get_queried_object_id()) ); ?></h2>
        <span class="count"><?php echo esc_html( bl_value('bl_clients_028', '5 clients', get_queried_object_id()) ); ?></span>
      </div>
      <div class="sector-grid row row-cols-2 row-cols-md-3 row-cols-lg-5 g-0">
        <div class="col"><div class="c-cell"><img src="<?php echo esc_url( bl_url( bl_value('bl_clients_066', 'clients/three-olives.png', get_queried_object_id()) ) ); ?>" alt="<?php echo esc_attr( bl_value('bl_clients_067', 'Three Olives', get_queried_object_id()) ); ?>"></div></div>
        <div class="col"><div class="c-cell"><img src="<?php echo esc_url( bl_url( bl_value('bl_clients_068', 'clients/nestle-toll-house.png', get_queried_object_id()) ) ); ?>" alt="<?php echo esc_attr( bl_value('bl_clients_069', 'Nestlé Toll House', get_queried_object_id()) ); ?>"></div></div>
        <div class="col"><div class="c-cell"><img src="<?php echo esc_url( bl_url( bl_value('bl_clients_070', 'clients/pizza-fusion.png', get_queried_object_id()) ) ); ?>" alt="<?php echo esc_attr( bl_value('bl_clients_071', 'Pizza Fusion', get_queried_object_id()) ); ?>"></div></div>
        <div class="col"><div class="c-cell"><img src="<?php echo esc_url( bl_url( bl_value('bl_clients_072', 'clients/tokana.png', get_queried_object_id()) ) ); ?>" alt="<?php echo esc_attr( bl_value('bl_clients_073', 'Tokana', get_queried_object_id()) ); ?>"></div></div>
        <div class="col"><div class="c-cell"><img src="<?php echo esc_url( bl_url( bl_value('bl_clients_074', 'clients/tonofa.png', get_queried_object_id()) ) ); ?>" alt="<?php echo esc_attr( bl_value('bl_clients_075', 'Tonofa', get_queried_object_id()) ); ?>"></div></div>
      </div>
    </div>

    <div class="sector reveal">
      <div class="sector-head">
        <h2><?php echo esc_html( bl_value('bl_clients_076', 'Entertainment & Media', get_queried_object_id()) ); ?></h2>
        <span class="count"><?php echo esc_html( bl_value('bl_clients_028', '5 clients', get_queried_object_id()) ); ?></span>
      </div>
      <div class="sector-grid row row-cols-2 row-cols-md-3 row-cols-lg-5 g-0">
        <div class="col"><div class="c-cell"><img src="<?php echo esc_url( bl_url( bl_value('bl_clients_077', 'clients/grand-cinemas.png', get_queried_object_id()) ) ); ?>" alt="<?php echo esc_attr( bl_value('bl_clients_078', 'Grand Cinemas', get_queried_object_id()) ); ?>"></div></div>
        <div class="col"><div class="c-cell"><img src="<?php echo esc_url( bl_url( bl_value('bl_clients_079', 'clients/empire-cinemas.png', get_queried_object_id()) ) ); ?>" alt="<?php echo esc_attr( bl_value('bl_clients_080', 'Empire Cinemas', get_queried_object_id()) ); ?>"></div></div>
        <div class="col"><div class="c-cell"><img src="<?php echo esc_url( bl_url( bl_value('bl_clients_081', 'clients/gazzaz.png', get_queried_object_id()) ) ); ?>" alt="<?php echo esc_attr( bl_value('bl_clients_082', 'Gazzaz Production', get_queried_object_id()) ); ?>"></div></div>
        <div class="col"><div class="c-cell"><?php echo esc_html( bl_value('bl_clients_083', 'Rekab', get_queried_object_id()) ); ?></div></div>
        <div class="col"><div class="c-cell"><?php echo esc_html( bl_value('bl_clients_084', 'Nashir', get_queried_object_id()) ); ?></div></div>
      </div>
    </div>

    <div class="sector reveal">
      <div class="sector-head">
        <h2><?php echo esc_html( bl_value('bl_clients_085', 'Education', get_queried_object_id()) ); ?></h2>
        <span class="count"><?php echo esc_html( bl_value('bl_clients_086', '2 clients', get_queried_object_id()) ); ?></span>
      </div>
      <div class="sector-grid row row-cols-2 row-cols-md-3 row-cols-lg-5 g-0">
        <div class="col"><div class="c-cell"><img src="<?php echo esc_url( bl_url( bl_value('bl_clients_087', 'clients/jeddah-campus.png', get_queried_object_id()) ) ); ?>" alt="<?php echo esc_attr( bl_value('bl_clients_088', 'Jeddah Campus', get_queried_object_id()) ); ?>"></div></div>
        <div class="col"><div class="c-cell"><img src="<?php echo esc_url( bl_url( bl_value('bl_clients_089', 'clients/madares-al-marefa.png', get_queried_object_id()) ) ); ?>" alt="<?php echo esc_attr( bl_value('bl_clients_090', 'Madares Al Marefa', get_queried_object_id()) ); ?>"></div></div>
      </div>
    </div>

    <div class="sector reveal">
      <div class="sector-head">
        <h2><?php echo esc_html( bl_value('bl_clients_091', 'Industrial & B2B', get_queried_object_id()) ); ?></h2>
        <span class="count"><?php echo esc_html( bl_value('bl_clients_092', '9 clients', get_queried_object_id()) ); ?></span>
      </div>
      <div class="sector-grid row row-cols-2 row-cols-md-3 row-cols-lg-5 g-0">
        <div class="col"><div class="c-cell"><img src="<?php echo esc_url( bl_url( bl_value('bl_clients_093', 'clients/haier.png', get_queried_object_id()) ) ); ?>" alt="<?php echo esc_attr( bl_value('bl_clients_094', 'Haier', get_queried_object_id()) ); ?>"></div></div>
        <div class="col"><div class="c-cell"><img src="<?php echo esc_url( bl_url( bl_value('bl_clients_095', 'clients/unicoil.png', get_queried_object_id()) ) ); ?>" alt="<?php echo esc_attr( bl_value('bl_clients_096', 'Unicoil', get_queried_object_id()) ); ?>"></div></div>
        <div class="col"><div class="c-cell"><img src="<?php echo esc_url( bl_url( bl_value('bl_clients_097', 'clients/neproplast.png', get_queried_object_id()) ) ); ?>" alt="<?php echo esc_attr( bl_value('bl_clients_098', 'Neproplast', get_queried_object_id()) ); ?>"></div></div>
        <div class="col"><div class="c-cell"><img src="<?php echo esc_url( bl_url( bl_value('bl_clients_099', 'clients/gulf-bridge.png', get_queried_object_id()) ) ); ?>" alt="<?php echo esc_attr( bl_value('bl_clients_100', 'Gulf Bridge', get_queried_object_id()) ); ?>"></div></div>
        <div class="col"><div class="c-cell"><img src="<?php echo esc_url( bl_url( bl_value('bl_clients_101', 'clients/asamco.png', get_queried_object_id()) ) ); ?>" alt="<?php echo esc_attr( bl_value('bl_clients_102', 'ASAMCO Almarbaie', get_queried_object_id()) ); ?>"></div></div>
        <div class="col"><div class="c-cell"><img src="<?php echo esc_url( bl_url( bl_value('bl_clients_103', 'clients/fmc.png', get_queried_object_id()) ) ); ?>" alt="<?php echo esc_attr( bl_value('bl_clients_104', 'FMC Construction', get_queried_object_id()) ); ?>"></div></div>
        <div class="col"><div class="c-cell"><img src="<?php echo esc_url( bl_url( bl_value('bl_clients_105', 'clients/jcc.png', get_queried_object_id()) ) ); ?>" alt="<?php echo esc_attr( bl_value('bl_clients_106', 'JCC Contracting', get_queried_object_id()) ); ?>"></div></div>
        <div class="col"><div class="c-cell"><img src="<?php echo esc_url( bl_url( bl_value('bl_clients_107', 'clients/first-fix.png', get_queried_object_id()) ) ); ?>" alt="<?php echo esc_attr( bl_value('bl_clients_108', 'First Fix', get_queried_object_id()) ); ?>"></div></div>
        <div class="col"><div class="c-cell"><img src="<?php echo esc_url( bl_url( bl_value('bl_clients_109', 'clients/al-haddad.png', get_queried_object_id()) ) ); ?>" alt="<?php echo esc_attr( bl_value('bl_clients_110', 'Al-Haddad Telecom', get_queried_object_id()) ); ?>"></div></div>
      </div>
    </div>

    <div class="sector reveal">
      <div class="sector-head">
        <h2><?php echo esc_html( bl_value('bl_clients_111', 'Services & Tech', get_queried_object_id()) ); ?></h2>
        <span class="count"><?php echo esc_html( bl_value('bl_clients_006', '10 clients', get_queried_object_id()) ); ?></span>
      </div>
      <div class="sector-grid row row-cols-2 row-cols-md-3 row-cols-lg-5 g-0">
        <div class="col"><div class="c-cell"><img src="<?php echo esc_url( bl_url( bl_value('bl_clients_112', 'clients/pointsgram.png', get_queried_object_id()) ) ); ?>" alt="<?php echo esc_attr( bl_value('bl_clients_113', 'Pointsgram', get_queried_object_id()) ); ?>"></div></div>
        <div class="col"><div class="c-cell"><img src="<?php echo esc_url( bl_url( bl_value('bl_clients_114', 'clients/briefill.png', get_queried_object_id()) ) ); ?>" alt="<?php echo esc_attr( bl_value('bl_clients_115', 'Briefill', get_queried_object_id()) ); ?>"></div></div>
        <div class="col"><div class="c-cell"><img src="<?php echo esc_url( bl_url( bl_value('bl_clients_116', 'clients/bridges.png', get_queried_object_id()) ) ); ?>" alt="<?php echo esc_attr( bl_value('bl_clients_117', 'Bridges Advertising', get_queried_object_id()) ); ?>"></div></div>
        <div class="col"><div class="c-cell"><img src="<?php echo esc_url( bl_url( bl_value('bl_clients_118', 'clients/optimal-concept.png', get_queried_object_id()) ) ); ?>" alt="<?php echo esc_attr( bl_value('bl_clients_119', 'Optimal Concept', get_queried_object_id()) ); ?>"></div></div>
        <div class="col"><div class="c-cell"><img src="<?php echo esc_url( bl_url( bl_value('bl_clients_120', 'clients/amid-consulting.png', get_queried_object_id()) ) ); ?>" alt="<?php echo esc_attr( bl_value('bl_clients_121', 'Amid Consulting', get_queried_object_id()) ); ?>"></div></div>
        <div class="col"><div class="c-cell"><img src="<?php echo esc_url( bl_url( bl_value('bl_clients_122', 'clients/ops.png', get_queried_object_id()) ) ); ?>" alt="<?php echo esc_attr( bl_value('bl_clients_123', 'OPS', get_queried_object_id()) ); ?>"></div></div>
        <div class="col"><div class="c-cell"><img src="<?php echo esc_url( bl_url( bl_value('bl_clients_124', 'clients/fastmile.png', get_queried_object_id()) ) ); ?>" alt="<?php echo esc_attr( bl_value('bl_clients_125', 'Fastmile', get_queried_object_id()) ); ?>"></div></div>
        <div class="col"><div class="c-cell"><img src="<?php echo esc_url( bl_url( bl_value('bl_clients_126', 'clients/baraya.png', get_queried_object_id()) ) ); ?>" alt="<?php echo esc_attr( bl_value('bl_clients_127', 'Baraya', get_queried_object_id()) ); ?>"></div></div>
        <div class="col"><div class="c-cell"><img src="<?php echo esc_url( bl_url( bl_value('bl_clients_128', 'clients/athr.png', get_queried_object_id()) ) ); ?>" alt="<?php echo esc_attr( bl_value('bl_clients_129', 'ATHR', get_queried_object_id()) ); ?>"></div></div>
        <div class="col"><div class="c-cell"><?php echo esc_html( bl_value('bl_clients_130', 'Finest Business', get_queried_object_id()) ); ?></div></div>
      </div>
    </div>

  </div>
</section>

<section class="quote-section">
  <blockquote class="reveal">
    <?php echo esc_html( bl_value('bl_clients_131', 'Our clients are our greatest assets and the', get_queried_object_id()) ); ?> <span class="accent"><?php echo esc_html( bl_value('bl_clients_132', 'heartbeat of BottomLine.', get_queried_object_id()) ); ?></span>
  </blockquote>
  <cite class="reveal"><?php echo esc_html( bl_value('bl_clients_133', 'The BottomLine Promise', get_queried_object_id()) ); ?></cite>
</section>

<section class="cta-banner">
  <h2><?php echo esc_html( bl_value('bl_clients_134', 'Join the', get_queried_object_id()) ); ?> <span style="color:var(--teal)"><?php echo esc_html( bl_value('bl_clients_135', 'next chapter.', get_queried_object_id()) ); ?></span></h2>
  <p><?php echo esc_html( bl_value('bl_clients_136', 'Marketing, communications, or your next flagship event — let\'s build something worth remembering.', get_queried_object_id()) ); ?></p>
  <a href="<?php echo esc_url( bl_url( bl_value('bl_clients_137', 'contact.html', get_queried_object_id()) ) ); ?>" class="btn btn-primary"><?php echo esc_html( bl_value('bl_clients_138', 'Start a project →', get_queried_object_id()) ); ?></a>
</section>

<?php get_template_part( 'template-parts/footer-clients' ); ?>

<?php get_template_part( 'template-parts/floating-contact' ); ?>

