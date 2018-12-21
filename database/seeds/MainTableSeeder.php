<?php

use App\TiposAtaques;
use Illuminate\Database\Seeder;
use App\LocalizacionesAnatomicas;

class MainTableSeeder extends Seeder{
	public function run(){
		TiposAtaques::create([
			'id' => 1,
			'nombre' => 'Mordedura'
		]);
		TiposAtaques::create([
			'id' => 2,
			'nombre' => 'Arañazo o rasguño'
		]);
		TiposAtaques::create([
			'id' => 3,
			'nombre' => 'Contácto de mucosa o piel lesionada con saliva o baba infectada con virus rábico'
		]);
		TiposAtaques::create([
			'id' => 4,
			'nombre' => 'Contácto de mucosa o piel lesionada, con tejido nervioso, material biológico o secreciones infectadas con virus rábico'
		]);
		TiposAtaques::create([
			'id' => 5,
			'nombre' => 'Inhalación en ambientes cargados o virus rábico (aerosoles)'
		]);
		TiposAtaques::create([
			'id' => 6,
			'nombre' => 'Transplante de órganos o tejidos infectados con virus rábico'
		]);
		LocalizacionesAnatomicas::create([
			'nombre' => 'Cabeza, cara, cuello'
		]);
		LocalizacionesAnatomicas::create([
			'nombre' => 'Manos, dedos'
		]);
		LocalizacionesAnatomicas::create([
			'nombre' => 'Tronco'
		]);
		LocalizacionesAnatomicas::create([
			'nombre' => 'Miembros superiores'
		]);
		LocalizacionesAnatomicas::create([
			'nombre' => 'Miembros inferiores'
		]);
		LocalizacionesAnatomicas::create([
			'nombre' => 'Pies, dedos'
		]);
		LocalizacionesAnatomicas::create([
			'nombre' => 'Genitales externos'
		]);
	}
}