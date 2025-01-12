<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Test;
use App\Models\Question;
use App\Models\Option;

class TestVocationalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Inserta encabezado del test, guía y descripción
        $test = Test::create([
            'name' => 'Test de Intereses Vocacionales y Profesionales',
            'description' =>
            "Este inventario es para ayudarle a descubrir tus opciones de interés vocacional. Cada persona cuenta con una personalidad propia.

             Y en este test te ayudará a ver tu area en la que podrías desempeñarte, esto solo ratifica tu personalidad y que no todo es de tu interés",

            'guide' => 'Lee con mucha atención cada actividad. Marca la casilla “Me interesa” o “No me interesa” según sea el caso. 
            Debes hacerlo solo en una de las dos columnas; de lo contrario, la respuesta será invalidada.'
        ]);

        $questions = [
            
            'Diseñar programas de computación y explorar nuevas aplicaciones tecnológicas para uso del internet.',
            'Criar, cuidar y tratar animales domésticos y de campo.',
            'Investigar sobre áreas verdes, medioambiente y cambios climáticos.',
            'Ilustrar, dibujar y animar digitalmente.',
            'Seleccionar, capacitar y motivar al personal de una organización o empresa.',
            'Realizar excavaciones para descubrir restos del pasado.',
            'Resolver problemas de cálculo para construir un puente.',
            'Diseñar cursos para enseñar a la gente sobre temas de salud e higiene.',
            'Tocar un instrumento y componer música.',
            'Planificar las metas de una organización pública o privada a mediano y largo plazos.',
            'Diseñar y planificar la producción masiva de artículos como muebles, autos, equipos de oficina, empaques y envases para alimentos y otros.',
            'Diseñar logotipos y portadas de una revista.',
            'Organizar eventos y atender a sus asistentes.',
            'Atender la salud de personas enfermas.',
            'Controlar ingresos y egresos de fondos y presentar el balance final de una institución.',
            'Hacer experimentos con plantas (frutas, árboles, flores).',
            'Concebir planos para viviendas, edificios y ciudadelas.',
            'Investigar y probar nuevos productos farmacéuticos.',
            'Hacer propuestas y formular estrategias para aprovechar las relaciones económicas entre dos países.',
            'Pintar, hacer esculturas, ilustrar libros de arte, etc.',
            'Elaborar campañas para introducir un nuevo producto al mercado.',
            'Examinar y tratar los problemas visuales.',
            'Defender a clientes individuales o empresas en juicios de diferente naturaleza.',
            'Diseñar máquinas que puedan simular actividades humanas.',
            'Investigar las causas y efectos de los trastornos emocionales.',
            'Supervisar las ventas de un centro comercial.',
            'Atender y realizar ejercicios a personas que tienen limitaciones físicas, problemas de lenguaje, etc.',
            'Prepararse para ser modelo profesional.',
            'Aconsejar a las personas sobre planes de ahorro e inversiones.',
            'Elaborar mapas, planos e imágenes para el estudio y análisis de datos geográficos.',
            'Diseñar juegos interactivos electrónicos para computadora.',
            'Realizar el control de calidad de los alimentos.',
            'Tener un negocio propio de tipo comercial.',
            'Escribir artículos periodísticos, cuentos, novelas y otros.',
            'Redactar guiones y libretos para un programa de tv.',
            'Organizar un plan de distribución y venta de un gran almacén.',
            'Estudiar la diversidad cultural en el ámbito rural y urbano.',
            'Gestionar y evaluar convenios internacionales de cooperación para el desarrollo social.',
            'Crear campañas publicitarias.',
            'Trabajar investigando la reproducción de peces, camarones y otros animales marinos.',
            'Dedicarse a fabricar productos alimenticios de consumo masivo.',
            'Gestionar y evaluar proyectos de desarrollo en una institución educativa y/o fundación.',
            'Rediseñar y decorar espacios físicos en viviendas, oficinas y locales comerciales.',
            'Administrar una empresa de turismo o agencias de viaje.',
            'Aplicar métodos alternativos a la medicina tradicional, para atender personas con dolencias de diversa índole.',
            'Diseñar ropa para niños, jóvenes y adultos de manera sustentable.',
            'Investigar organismos vivos para elaborar vacunas.',
            'Manejar o dar mantenimiento a dispositivos tecnológicos en aviones, barcos, radares, etc.',
            'Estudiar idiomas extranjeros —actuales y antiguos— para hacer traducción.',
            'Restaurar piezas y obras de arte.',
            'Revisar y dar mantenimiento a artefactos eléctricos, electrónicos y computadoras.',
            'Enseñar a niños de cero a cinco años.',
            'Investigar y sondear nuevos mercados.',
            'Atender la salud dental de las personas.',
            'Tratar a niños, jóvenes y adultos con problemas psicológicos.',
            'Crear estrategias de promoción y venta de nuevos productos nacionales en el mercado internacional.',
            'Planificar y recomendar dietas para personas diabéticas o con sobrepeso.',
            'Trabajar en una empresa petrolera en un cargo técnico como control de la producción.',
            'Administrar una empresa (familiar, privada o pública).',
            'Tener un taller de reparación y mantenimiento de carros, tractores, etcétera.',
            'Ejecutar proyectos de extracción minera y metalúrgica.',
            'Asistir a directivos de multinacionales con manejo de varios idiomas.',
            'Diseñar programas educativos para niños con discapacidad.',
            'Aplicar conocimientos de estadística en investigaciones en diversas áreas (social, administrativa, salud, etcétera).',
            'Fotografiar hechos históricos, lugares significativos, rostros, paisajes para el área publicitaria, artística, periodística y social.',
            'Trabajar en museos y bibliotecas nacionales e internacionales.',
            'Ser parte de un grupo de teatro.',
            'Producir cortometrajes, spots publicitarios, programas educativos, de ficción, etc.',
            'Estudiar la influencia entre las corrientes marinas y el clima y sus consecuencias ecológicas.',
            'Conocer las distintas religiones (su filosofía) y transmitirlas a la comunidad en general.',
            'Asesorar a inversionistas en la compra de bienes y acciones en mercados nacionales e internacionales.',
            'Estudiar grupos étnicos, sus costumbres, tradiciones, cultura y compartir sus vivencias.',
            'Explorar el espacio sideral, los planetas, características y componentes.',
            'Mejorar la imagen facial y corporal de las personas aplicando diferentes técnicas.',
            'Decorar jardines de casas y parques públicos.',
            'Administrar y renovar menús de comida en un hotel o restaurante.',
            'Trabajar como presentador de televisión, locutor de radio y televisión, animador de programas culturales y concursos.',
            'Diseñar y ejecutar programas de turismo.',
            'Administrar y ordenar adecuadamente la ocupación del espacio físico de ciudades, países, etc., utilizando imágenes de satélite y mapas.',
            'Organizar, planificar y administrar centros educativos.'

        ];

        //Insertamos preguntas y opciones
        foreach ($questions as $question_text) {
            $question = Question::create([
                'testId' => $test->testId,
                'question_text' => $question_text,
                'type' => 'multiple_choice'
            ]);

            $options = [
                ['optionText' => '1 - Me interesa', 'isCorrect' => false, 'value' => 1],
                ['optionText' => '2 - No me interesa', 'isCorrect' => false, 'value' => 2],
            ];

            //Insertamos opciones por cada pregunta
            foreach ($options as $option) {
                Option::create([
                    'questionId' => $question->questionId,
                    'optionText' => $option['optionText'],
                    'isCorrect' => $option['isCorrect'],
                    'value' => $option['value'],
                ]);
            }
        }
    }
}
