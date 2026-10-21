<?php
// Rebuilds the PowerCo theme Spanish translation (es_ES.po / es_ES.mo).
// Add or change strings in $es below, then run:
//   C:\xampp\php\php.exe setup\make-es-mo.php C:/xampp/htdocs/wordpress-web wp-content/themes/powerco/languages
$wp = rtrim( $argv[1], '/' );
define( 'ABSPATH', $wp . '/' );
define( 'WPINC', 'wp-includes' );
require $wp . '/wp-includes/compat.php';
require $wp . '/wp-includes/pomo/po.php';
require $wp . '/wp-includes/pomo/mo.php';

$es = array(
	// Header
	'Call us:'        => 'Llámenos:',
	'Request a Quote' => 'Solicitar cotización',
	'Careers'         => 'Empleo',
	'Search'          => 'Buscar',
	'Search…'         => 'Buscar…',
	'Menu'            => 'Menú',
	'Language'        => 'Idioma',
	// Homepage
	'Our Products'           => 'Nuestros productos',
	'What Our Customers Say' => 'Lo que dicen nuestros clientes',
	'The equipment arrived on schedule and has run flawlessly since installation.'      => 'El equipo llegó a tiempo y ha funcionado a la perfección desde su instalación.',
	'Operations Manager, Container Terminal'                                            => 'Gerente de Operaciones, Terminal de Contenedores',
	'Their engineering team worked with us to design exactly what our facility needed.' => 'Su equipo de ingeniería trabajó con nosotros para diseñar exactamente lo que nuestra planta necesitaba.',
	'Facilities Director, Manufacturing Plant'                                          => 'Director de Instalaciones, Planta de Manufactura',
	'Outstanding quality and responsive support every step of the way.'                 => 'Calidad excepcional y soporte atento en cada paso.',
	'Project Engineer, Port Authority'                                                  => 'Ingeniero de Proyectos, Autoridad Portuaria',
	'Reliable power for every show, in every venue, every time.'                        => 'Energía confiable para cada espectáculo, en cada recinto, siempre.',
	'Production Manager, Live Events'                                                   => 'Gerente de Producción, Eventos en Vivo',
	'A true partner — knowledgeable, flexible and easy to work with.'                   => 'Un verdadero socio: experto, flexible y fácil de trabajar.',
	'Procurement Lead, Shipyard'                                                        => 'Jefe de Compras, Astillero',
	'Their shore power solution helped us cut emissions at berth significantly.'        => 'Su solución de energía en puerto nos ayudó a reducir significativamente las emisiones en el muelle.',
	'Environmental Manager, Marine Terminal'                                            => 'Gerente Ambiental, Terminal Marítima',
	'Custom panels built right the first time. We will be back.'                        => 'Paneles a medida hechos bien a la primera. Volveremos.',
	'Electrical Contractor'                                                             => 'Contratista Eléctrico',
	'OWN IT!'          => '¡HAZLO TUYO!',
	'Employee owned.'  => '100% propiedad de los empleados.',
	'Every team member has a stake in the quality of what we build and the service we deliver.' => 'Cada miembro del equipo participa en la calidad de lo que fabricamos y del servicio que ofrecemos.',
	'About Us'         => 'Sobre nosotros',
	'Our Core Values'  => 'Nuestros valores',
	'Integrity'        => 'Integridad',
	'Quality'          => 'Calidad',
	'Innovation'       => 'Innovación',
	'Customer Focus'   => 'Enfoque en el cliente',
	'Teamwork'         => 'Trabajo en equipo',
	'Sustainability'   => 'Sostenibilidad',
	'Join Our Team'    => 'Únase a nuestro equipo',
	'Build a career powering a more sustainable future.' => 'Construya una carrera impulsando un futuro más sostenible.',
	'View Careers'     => 'Ver empleos',
	'Contact Us'       => 'Contáctenos',
	'Address'          => 'Dirección',
	'Phone'            => 'Teléfono',
	'Email'            => 'Correo electrónico',
	'Toll free:'       => 'Línea gratuita:',
	// Products
	'Intermodal / Reefer'                    => 'Intermodal / Refrigerados',
	'Shore Power'                            => 'Energía en puerto',
	'Emergency Power'                        => 'Energía de emergencia',
	'Entertainment Power'                    => 'Energía para entretenimiento',
	'Refrigerated Truck-Trailer Shore Power' => 'Energía en puerto para remolques refrigerados',
	'ERTG'                                   => 'ERTG',
	'Shipyard Power'                         => 'Energía para astilleros',
	'Wayside Power'                          => 'Energía ferroviaria',
	'Industrial / Portable Power'            => 'Energía industrial / portátil',
	'Custom Control Panels'                  => 'Paneles de control a medida',
	// Footer
	'Phone:'           => 'Teléfono:',
	'MADE IN USA'      => 'HECHO EN EE. UU.',
	'Products'         => 'Productos',
	'Have a question?' => '¿Tiene alguna pregunta?',
	'Our team is ready to help you find the right solution.' => 'Nuestro equipo está listo para ayudarle a encontrar la solución adecuada.',
	'Request Info'     => 'Solicitar información',
	'Copyright'        => 'Derechos de autor',
	'Privacy Policy'   => 'Política de privacidad',
	'Terms of Use'     => 'Términos de uso',
	// Other templates
	'Home'                   => 'Inicio',
	'Search results for “%s”' => 'Resultados de búsqueda para “%s”',
	'Blog'                   => 'Blog',
	'Nothing found.'         => 'No se encontró nada.',
);

$headers = array(
	'Project-Id-Version'        => 'PowerCo theme',
	'Language'                  => 'es_ES',
	'MIME-Version'              => '1.0',
	'Content-Type'              => 'text/plain; charset=UTF-8',
	'Content-Transfer-Encoding' => '8bit',
	'Plural-Forms'              => 'nplurals=2; plural=(n != 1);',
);

$po = new PO();
$mo = new MO();
foreach ( $headers as $k => $v ) {
	$po->set_header( $k, $v );
	$mo->set_header( $k, $v );
}
foreach ( $es as $en => $tr ) {
	$entry = new Translation_Entry( array( 'singular' => $en, 'translations' => array( $tr ) ) );
	$po->add_entry( $entry );
	$mo->add_entry( $entry );
}

$dir = rtrim( $argv[2], '/' );
if ( ! is_dir( $dir ) ) {
	mkdir( $dir, 0755, true );
}
$po->export_to_file( $dir . '/es_ES.po' );
$mo->export_to_file( $dir . '/es_ES.mo' );
echo count( $es ) . " strings written to $dir\n";
