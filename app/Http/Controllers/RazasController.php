<?php

namespace App\Http\Controllers;

use App\Razas;
use Illuminate\Http\Request;
use App\Http\Requests\RazaFormRequest;

class RazasController extends Controller{
	const DIR_TEMPLATE = 'razas.';
	protected $razasList;
	public function __construct(){
		$this->razasList = [
			(object) [
				'nombre' => 'Dogo Argentino',
				'image' => '/img/dogs/dogoargentino.jpg',
				'historia' => '
					<p>El Dogo Argentino es un cazador de piezas de caza mayor que es capaz de seguirle el rastro a la presa a través de bosques de densas praderas y de arbustos. La exuberante musculatura y su poderosa estructura le confieren una  gran fuerza y  extraordinaria agilidad, rapidez y resistencia. Esta  raza ha conocido el éxito no sólo en la caza sino también en las pruebas de obediencia, el trabajo militar y policial, el Schutzhund y la búsqueda y rescate, además de utilizarse como perro lazarillo.</p>
				',
				'caracteristica' => '
					<ul>
						<li>Altura a la cruz: de 60 a 65 cm</li>
						<li>Peso: de 40 a 45 kg</li>
						<li>Promedio de vida: doce años</li>
					</ul>
					<b>Comportamiento</b>
					<p>Dogo Argentino tiene un fuerte temperamento, una gran inteligencia y, como la mayoría de perros, trabaja muy duro para complacer a su amo. Esto hace que la raza sea ideal para el adiestramiento de obediencia además de para el adiestramiento para usos prácticos, como las tareas en casa o en la granja. De todas formas, existen unos pocos elementos que deben tenerse en cuenta cuando se lleva a cabo un programa de adiestramiento. Es una raza amistosa con la gente y que establece un vínculo fuerte y duradero con su amo y su familia.</p>
					<b>Cuidados y salud</b>
					<p>Es susceptible a padecer la displasia de cadera (DC). Cuando lo adquiera, asegúrese de obtener del criador un certificado conforme sus caderas están sanas. Otro problema congénito que se debe tener en cuenta es la sordera. La mayoría de las razas de capa blanca, entre las que se incluye el Dogo Argentino, parecen tener una alta incidencia de este mal. Un perro puede ser sordo de un oído (sordo unilateral) o de ambos (sordo bilateral). El único examen auditivo reconocido es el de la Respuesta Auditiva Evocada por el Tallo Cerebral (RAETC), que se suele llevar a cabo en los cachorros de ocho o más semanas de vida. Los criadores responsables deberían proporcionarles los resultados de la prueba RAETC a todos los propietarios de un Dogo Argentino.</p>
				',
				'id' => 1
			],
			(object) [
				'nombre' => 'Dogo de Burdeos',
				'image' => '/img/dogs/dogoburne.jpg',
				'historia' => '
					<p>El Dogo de Burdeos es una de las razas de perro francesas más antiguas y su origen está en los perros mastines orientales que llegaron a Europa. Antiguamente se utilizaban sobre todo para la lucha contra toros, osos y perros, Poco a poco pasaron a ser los guardianes de los hogares y de los castillos.</p>
				',
				'caracteristica' => '
					<ul>
						<li>Peso: 50 kg.</li>
						<li>Altura: 58 a 60 cm.</li>
						<li>Esperanza de vida: 5 a 8 años.</li>
						<li>Rasgos Físicos: Musculoso, fuerte, cabeza de gran tamaño, ojos pequeños, orejas pequeñas y caídas, pelaje corto, cola gruesa y fuerte.</li>

					</ul>
					<b>Comportamiento</b>
					<p>A pesar del origen bélico del Dogo de Burdeos, el comportamiento general es tranquilo, equilibrado, agradable y cariñoso. Tiene un apego especial hacia su dueño, siendo muy cariñoso y fiel. En cuanto a los niños, tiende a ser muy manso y paciente además de muy cuidadoso y protector. No le gusta la soledad y a pesar de poder llegar a ser algo tozudo, si aprende una orden la respetará.</p>
					<b>Cuidados y salud</b>
					<p>Al ser un perro de bastante tamaño come mucho y puede llegar a comer un kilo de comida al día, por lo que necesita mucha alimentación. A la hora de pasear al Dogo de Burdeos, es importante controlarlo bien ya que por sus características y por su tamaño puede impresionar a mucha gente y se pueden sentir intimidados por su aspecto.Al igual que puede ocurrir con otros perros de similar tamaño, el Dogo de Burdeos puede padecer displasia de cadera, y además puede tener la piel sensible.</p>
				',
				'id' => 2
			],
			(object) [
				'nombre' => 'Akita Inu',
				'image' => '/img/dogs/123.jpg',
				'historia' => '
					<p>El Akita Inu proviene de Japón, de la región de Akita, situada en la Isla de Honshu. Sus antepasados los empleaban para cazar osos y para acompañar a los guerreros en el combate.En el siglo XVII comenzaron a emplearse en peleas de perros y se cruzaron con mastines y tosas, con el fin de crear una raza más fuerte y resistente, consiguiendo así aumentar el tamaño del Akita.Tras la Segunda Guerra Mundial, la raza estaba al borde de la extinción y los criadores estadounidenses decidieron reponer la raza siguiendo la línea de mastín y ovejero. De ahí nació el Akita americano. Los japoneses, sin embargo, consideraron que esa línea no representaba el estilo propio japonés y decidieron repoblar la raza usando los akita matagi.</p>
				',
				'caracteristica' => '
					<ul>
						<li>Origen:Japonés.</li>
						<li>Peso:25 a 45 Kg.</li>
						<li>Altura:55 a 70 cm.</li>
						<li>esperanza de vida: 10 a 15 años</li>
						<li>Rasgos Físicos:Robusto, musculoso, fuerte, elegante, majestuoso, orejas pequeñas, ojos marrones, cola curva, pelo largo.</li>
					</ul>
					<b>Comportamiento</b>
					<p>El Akita Inu es un perro honesto, valiente e inteligente. Es de carácter un tanto impetuoso e independiente, por lo que no resulta un perro especialmente dócil, aunque con una educación firme puede adaptarse perfectamente a la vida familiar. En este ámbito, se muestra cariñoso y confiable. Es un buen guardián y gran defensor de los suyos..</p>
					<b>Cuidados y salud</b>
					<p>Desarrolla ciertas enfermedades como la displasia de caderas, problemas en la tiroides, en las rodillas y en el sistema inmunológico. También es propenso a la torsión de estómago.Necesita ejercicio frecuente aunque no excesivo, y puede habituarse a vivir en un piso sin olvidar los paseos diarios. Hay que ser constantes en su educación para controlar su fuerte carácter y procurarle mucho cariño. En cuanto al cuidado del pelo, requiere bastante dedicación sobretodo en época de muda, que ocurre dos veces al año. Lo mejor es un cepillado frecuente, al menos una vez al día, pero no es necesario cortarle el pelo.</p>
				',
				'id' => 3
			],
			(object) [
				'nombre' => 'Mastín Napolitano',
				'image' => '/img/dogs/Mas.jpg',
				'historia' => '
					<p>El Mastín Napolitano desciende del Mastín del Tíbet y se intuye que llegó a las costas napolitanas hacia el siglo IV.Debido a su descomunal fuerza, los romanos los utilizaron en peleas, como bestias de carga y también como perros guardianes. La historia de esta raza sigue los pasos de la del imperio romano. Con la caída de éste casi desaparecieron, y no fue hasta 1946 que se tomaron medidas para salvaguardar el futuro de la raza.</p>
				',
				'caracteristica' => '
					<ul>
						<li>Origen: Italia.</li>
						<li>Peso:68 Kg.</li>
						<li>Altura:80 cm.</li>
						<li>Esperanza de vida:10 años </li>
						<li>Rasgos Físicos: Fuerte, robusto,musculoso,orejas caídas, gran papada, El color de su pelo es muy variado.</li>
					</ul>
					<b>Comportamiento</b>
					<p>Este mastín es muy inteligente, manso y noble. Tiene un carácter muy equilibrado, defiende su territorio con firmeza, pero sabe controlar su fuerza y potencia, demostrando un gran autocontrol. Se muestra muy seguro de sí mismo. Es cariñoso y entrañable, sobre todo con los niños y con sus dueños, con quienes además se muestra siempre fiel.</p>
					<b>Cuidados y salud</b>
					<p>Necesita un espacio muy amplio y abundante comida, así como ejercicio físico regular. Hay que cepillar su pelaje frecuentemente. Su gran tamaño puede acarrearle problemas como la torsión de estómago.</p>
				',
				'id' => 4
			],
			(object) [
				'nombre' => 'Dóbermann',
				'image' => '/img/dogs/dormen.jpg',
				'historia' => '
					<p>El perro dobermann proviene de una serie de cruces de diferentes razas caninas: el primero de ellos tuvo lugar hace dos siglos, entre un perro callejero de raza desconocida y un pinscher, de la mano del "creador" de la raza, Karl Friedrich Louis Dobermann; después de varias mezclas más tuvo lugar el cruce definitivo gracias a Otto Göller, entre un terrier negro y un Greyhound, obteniendo así el ejemplar de dobermann definitivo.Ha participado en las dos Guerras Mundiales: en la primera de ellas, sirvió al ejército como perro guardián, sanitario y de correo; ya en la II G.M. fue utilizado por Hitler para realizar diversas funciones de guardia y de defensa.</p>
				',
				'caracteristica' => '
					<b>Hembra</b>
					<ul>
						<li>Peso: 32 a 35 kg.</li>
						<li>Altura: 63 a 68 cm.</li>
					</ul>
					<b>Macho</b>
					<ul>
						<li>Peso: 40 a 45 kg.</li>
						<li>Altura: 68 a 72 cm.</li>
					</ul>
					<b>Comportamiento</b>
					<p>Se destaca por su inteligencia y tiene la capacidad de razonar bastante desarrollada, con lo que no es complicado amaestrarle. Es muy importante socializarle en los primeros meses de vida, fomentando el entrenamiento de obediencia y facilitándole que realice ejercicio de forma continuada.Mantiene con su amo una relación muy estrecha, es valiente, astuto, fiel y siempre estará en alerta, desconfiará de todo lo que desconozca.</p>
					<b>Cuidados y salud</b>
					<p>La alimentación que deben seguir los cachorros de esta raza tiene que ser baja en proteínas. En cuanto al cuidado del pelo, no es necesario cepillarlo diariamente, con pasarle un cepillo de goma o un calcetín de lana para eliminar los pelos restantes sería suficiente. No requiere que se le bañe con asiduidad, pero cuando se le lave hay que utilizar siempre un champú suave.</p>
				',
				'id' => 5
			],
			(object) [
				'nombre' => 'Bull Terrier',
				'image' => '/img/dogs/bull.jpg',
				'historia' => '
					<p>James Hinks, presentó a la sociedad un perro Desciende de las razas old english bulldog y old english terrier, ya desaparecidas, con algunas gotas genéticas de los dálmatas. En un principio, Hinks concibió los cruces para criar un buen can de peleas, a las que eran entonces muy aficionados en las Islas, pero los buenos resultados cosechados en certámenes de belleza le convencieron de potenciar sus rasgos estéticos. Aquel empeño dio como fruto la estirpe moderna, menos tosca que la de sus ancestros. El orgullo del criador británico fue una hembra totalmente blanca llamada Puss, que causó sensación por su elegancia en un concurso de 1863.</p>
				',
				'caracteristica' => '
					<ul>
						<li>Peso: 34 kg.</li>
						<li>altura: 56 cm. </li>
						<li>Esperanza de vida: 10 a 14 años.</li>
						<li>Origen: Birminghan en Inglaterra.</li>
					</ul>
					<b>Rasgos físicos</b>
					<p>Tamaño mediano, fuerte, musculoso, hocico sobresaliente, ojos pequeños, color Blanco, manchado o tricolor.</p>
					<b>Comportamiento</b>
					<p>Es un perro muy valiente, leal, activo y apegado a su dueño. No soporta muy bien la soledad, se vuelve ansioso y puede llegar a romper cosas; necesita compañía y afecto.</p>
					<b>Cuidados y salud</b>
					<p>Debido a que su pelo es un pelo corto y duro no necesitan grandes cuidados. Tan solo un cepillado permitirá mantener el aspecto del Bull Terrier en perfecto estado. A pesar de que tienen un oído muy fino, es importante realizar pruebas de audición cuando son cachorros ya que esta raza es una de las más proclives a sorderas junto con los dálmatas.</p>
				',
				'id' => 6
			],
			(object) [
				'nombre' => 'Rottweiler',
				'image' => '/img/dogs/Rou.jpg',
				'historia' => '
					<p>El Rottweiler es uno de los perros más antiguos que existen. Se cree que en la época del Imperio Romano los antepasados de este can eran utilizados para labores de protección y conducción del ganado, además de ser una excelente compañía para los legionarios romanos que combatían fuera del país transalpino, se instalaron en Alemania, concretamente en Rottweil (de ahí la denominación actual), y de la mezcla con otros perros nativos germanos nacería la raza tal y como la conocemos hoy en día.</p>
					<p>Obtuvo un nuevo apodo (perro de carnicero de Rottweil), ya que los carniceros los utilizaban como acompañante y protección cuando iban a las ferias a adquirir ganado, de su cuello colgándoles una bolsita con un collar donde guardaban las monedas. En 1910 sería nombrado oficialmente perro policía, prestando sus servicios tanto al cuerpo de policía como al ejército.</p>
				',
				'caracteristica' => '
					<b>Hembra</b>
					<ul>
						<li>Peso: 40Kg</li>
						<li>Altura: 56 a 63 Cm.</li>
					</ul>
					<b>Macho</b>
					<ul>
						<li>Peso:50 Kg.</li>
						<li>Altura:61 a 68 Cm.</li>
						<li>Origen:Alemania</li>
						<li>Esperanza de vida: 9 a 11 años.</li>
					</ul>
					<b>Rasgos físicos</b>
					<p>robusto, fuerte, cabeza ancha y grande, hocico profundo y de forma cuadrada, orejas caídas de forma triangular, Color negro con manchas rojizas situadas en zonas como el hocico, el pecho, la garganta, las extremidades, las mejillas y bajo la cola, principalmente.</p>
					<b>Comportamiento</b>
					<p>Los ejemplares de esta raza son amistosos, tranquilos, obedientes y alegres. Además, esta raza está considerada como una de las diez más inteligentes dentro del mundo canino.</p>
					<b>Cuidados y salud</b>
					<p>Su manto de pelo es fácil de cuidar, para mantenerlo limpio es recomendable cepillárselo con un cepillo de cerdas firmes como mínimo una vez a la semana. Por otro lado, solamente hay que bañarle cuando se crea necesario.</p>
					<p>Puede vivir dentro de un apartamento, siempre y cuando se le saque a hacer ejercicio todos los días, actividad que tendrá que realizar durante 2 o 3 horas, con el fin de mantener una buena salud mental y física. Cuando son cachorros es muy importante que mantengan una carga de ejercicio regular, ya que, en caso contrario, sus extremidades podrían atrofiarse.</p>
				',
				'id' => 7
			],
			(object) [
				'nombre' => 'PitBull',
				'image' => '/img/dogs/man.jpg',
				'historia' => '
					<p>También conocido con el nombre de American Pit Bull Terrier, este perro tiene como origen la Gran Bretaña del siglo XIX. Diversas teorías aseguran que esta raza ya existía en la época del Imperio Romano. Es descendiente de los perros que se utilizaban en los espectáculos clandestinos donde se enfrentaban a osos y toros, y que más tarde, serían protagonistas en las peleas ilegales entre ejemplares de la misma especie.</p>
				',
				'caracteristica' => '
					<b>Hembra</b>
					<ul>
						<li>Peso: 14Kg a 23 Kg</li>
						<li>Altura: 35 a 45 Cm.</li>
					</ul>
					<b>Macho</b>
					<ul>
						<li>Peso: 15 a 28 Kg.</li>
						<li>Altura: 38 a 40 Cm.</li>
						<li>Origen:Estados unidos.</li>
						<li>Esperanza de vida: 12 años.</li>
					</ul>
					<b>Rasgos físicos</b>
					<p>cuerpo musculoso,fuerte, atlético,cabeza ancha y robusta,ojos redondos,mandibula potente y dientes bien encajados,pelo suave y radiente.</p>
					<b>Comportamiento</b>
					<p>El Pitbull es una raza de perro calificada de potencialmente peligrosa, pero aunque la mayoría de la gente piensa que los ejemplares de esta raza canina son agresivos, la realidad es que a pesar de tener un impulso de presa bastante desarrollado, no se le puede catalogar como una máquina de matar. De hecho, puede llegar a ser muy sociable con responsabilidad y una buena educación, si ha recibido un correcto proceso de adiestramiento desde que ha sido cachorro, que será sencillo gracias a su inteligencia.</p>
					<b>Cuidados y salud</b>
					<p>Conviene destacar que es una raza que presenta una salud excelente, con lo que normalmente no sufren enfermedades a lo largo de su vida. Con visitar periódicamente al veterinario y llevar al día el calendario de sus vacunas sería suficiente para que nuestra mascota esté sana.Su pelo no requiere cuidados especiales, si bien sería recomendable que sea cepillado de forma regular y bañarlo si se ha ensuciado. Así mantendremos la higiene de nuestro Pitbull en perfectas condiciones.Es sumamente importante que realice ejercicio físico, haciéndole correr y sacándole a pasear por lo menos una hora diaria, teniendo especial cuidado a que no se pelee con otros perros.</p>
				',
				'id' => 8
			],
			(object) [
				'nombre' => 'Presa canario',
				'image' => '/img/dogs/presa.jpg',
				'historia' => '
					<p>También conocido con el nombre de American Pit Bull Terrier, este perro tiene como origen la Gran Bretaña del siglo XIX. Diversas teorías aseguran que esta raza ya existía en la época del Imperio Romano. Es descendiente de los perros que se utilizaban en los espectáculos clandestinos donde se enfrentaban a osos y toros, y que más tarde, serían protagonistas en las peleas ilegales entre ejemplares de la misma especie.</p>
				',
				'caracteristica' => '
					<b>Hembra</b>
					<ul>
						<li>Peso: 14Kg a 23 Kg</li>
						<li>Altura: 35 a 45 Cm.</li>
					</ul>
					<b>Macho</b>
					<ul>
						<li>Peso: 15 a 28 Kg.</li>
						<li>Altura: 38 a 40 Cm.</li>
						<li>Origen:Estados unidos.</li>
						<li>Esperanza de vida: 12 años.</li>
					</ul>
					<b>Rasgos físicos</b>
					<p>cuerpo musculoso,fuerte, atlético,cabeza ancha y robusta,ojos redondos,mandibula potente y dientes bien encajados,pelo suave y radiente.</p>
					<b>Comportamiento</b>
					<p>El Pitbull es una raza de perro calificada de potencialmente peligrosa, pero aunque la mayoría de la gente piensa que los ejemplares de esta raza canina son agresivos, la realidad es que a pesar de tener un impulso de presa bastante desarrollado, no se le puede catalogar como una máquina de matar. De hecho, puede llegar a ser muy sociable con responsabilidad y una buena educación, si ha recibido un correcto proceso de adiestramiento desde que ha sido cachorro, que será sencillo gracias a su inteligencia.</p>
				',
				'id' => 9
			]
		];
	}
	public function listWithOutAuth(Request $request){
		return view(self::DIR_TEMPLATE.'list_without_auth', [
			'razas' => $this->razasList
		]);
	}
	public function detail($raza, $mode){
		return view(self::DIR_TEMPLATE.'detail_modal', [
			'raza' => $this->razasList[$raza - 1],
			'mode' => $mode
		]);
	}
	public function listWithAuth(Request $request){
		$query = $request->input('query');
		$razas = $query != null && $query != '' ? Razas::whereRaw('LOWER(nombre) LIKE ?', ['%'.strtolower($query).'%']) : new Razas();
		return view(self::DIR_TEMPLATE.'list_with_auth', [
			'query' => $query,
			'url' => route('listar_razas_with_auth'),
			'placeholder' => 'Busca una raza',
			'razas' => $razas->paginate(10)
		]);
	}
	public function new(){
		return view(self::DIR_TEMPLATE.'form', [
			'raza' => new Razas(),
			'title' => 'Agregar una raza',
			'route' => ['crear_raza.post'],
			'method' => 'post'
		]);
	}
	public function edit(Razas $raza){
		return view(self::DIR_TEMPLATE.'form', [
			'raza' => $raza,
			'title' => 'Edita la información de la raza',
			'route' => ['editar_raza.post', $raza->id],
			'method' => 'put'
		]);
	}
	public function saveOrUpdateData(Request $razaRequest){
		$message = '';
		if($razaRequest->raza){
			Razas::updateData($razaRequest);
			$message = 'Raza actualizada con éxito';
		}else{
			Razas::saveData([
				'nombre' => $razaRequest->nombre,
				'especie' => $razaRequest->especie
			]);
			$message = 'Raza guardada con éxito';
		}
		$razaRequest->session()->flash('message.level', 'success');
		$razaRequest->session()->flash('message.content', $message);
		return redirect()->route('listar_razas_with_auth');
	}
	public function delete(Razas $raza){
		return view('elements.delete_form', [
			'object' => $raza,
			'title' => 'Eliminar raza',
			'message' => "¿Desea eliminar la raza {$raza->nombre}?",
			'route' => ['eliminar_raza.delete', $raza->id]
		]);
	}
	public function deleteData(Razas $raza, Request $request){
		$message = '';
		if($raza->mascotas->count() > 0){
			$message = 'No se puede eliminar la raza por que se encuentra asociada';
		}else{
			$raza->delete();
			$message = 'Raza eliminada con éxito';
		}
		$request->session()->flash('message.level', 'success');
		$request->session()->flash('message.content', $message);
		return redirect()->route('listar_razas_with_auth');
	}
}