<?php

use App\TiposAtaques;
use Illuminate\Database\Seeder;
use App\LocalizacionesAnatomicas;
use App\Razas;

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
		Razas::create([
			'nombre' => 'American Staffordshire Terrier',
			'especie' => 'C'
		]);
		Razas::create([
			'nombre' => 'Bullmastiff',
			'especie' => 'C'
		]);
		Razas::create([
			'nombre' => 'Dóberman',
			'especie' => 'C'
		]);
		Razas::create([
			'nombre' => 'Dogo Argentino',
			'especie' => 'C'
		]);
		Razas::create([
			'nombre' => 'Dogo de Burdeos',
			'especie' => 'C'
		]);
		Razas::create([
			'nombre' => 'Fila Brasileiro',
			'especie' => 'C'
		]);
		Razas::create([
			'nombre' => 'Mastín Napolitano',
			'especie' => 'C'
		]);
		Razas::create([
			'nombre' => 'PitBull Terrier',
			'especie' => 'C'
		]);
		Razas::create([
			'nombre' => 'American Pit Bull Terrier',
			'especie' => 'C'
		]);
		Razas::create([
			'nombre' => 'De presa canario',
			'especie' => 'C'
		]);
		Razas::create([
			'nombre' => 'Rottweiler',
			'especie' => 'C'
		]);
		Razas::create([
			'nombre' => 'Staffordshire Terrier',
			'especie' => 'C'
		]);
		Razas::create([
			'nombre' => 'Tosa Japonés',
			'especie' => 'C'
		]);
		Razas::create([
			'nombre' => 'Bull Terrier',
			'especie' => 'C'
		]);
		Razas::create([
			'nombre' => 'Akita Inu',
			'especie' => 'C'
		]);
	}
}