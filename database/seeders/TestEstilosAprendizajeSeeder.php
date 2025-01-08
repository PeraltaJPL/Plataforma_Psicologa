<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Test;
use App\Models\Question;
use App\Models\Option;

class TestEstilosAprendizajeSeeder extends Seeder
{
    public function run(): void
    {
        //Inserta encabezado del test, guía y descripción
        $test = Test::create([
            'name' => 'Estilos de Aprendizaje',
            'description' =>
            "Este inventario es para ayudarle a descubrir su manera preferida de aprender. Cada persona tiene su manera preferida de aprender. Reconocer sus preferencias le ayudará a comprender sus fuerzas en cualquier situación de aprendizaje.

            Por favor, responda Ud. verdaderamente a cada pregunta. Responda Ud. según lo que hace actualmente, no según lo que piense que sea la respuesta correcta.

            Use Ud. la escala siguiente para responder a cada pregunta: Ponga un círculo sobre su respuesta.",
            'guide' => 'Use la escala siguiente para responder: 1 = Nunca, 2 = Raramente, 3 = Ocasionalmente, 4 = Usualmente, 5 = Siempre.'
        ]);

        $questions = [
            'Prefiero aprender con ejemplos prácticos.',
            'Entiendo mejor cuando leo o estudio por mi cuenta.',
            'Me gusta trabajar en equipo para resolver problemas.',
            'Prefiero aprender viendo videos o diagramas.',
            'Disfruto escuchar explicaciones antes de comenzar.',
            'Me siento más cómodo aprendiendo con actividades físicas o manuales.',
            'Me gusta resolver problemas de forma lógica y estructurada.',
            'Entiendo mejor cuando alguien me explica verbalmente.',
            'Aprendo más cuando escribo resúmenes o apuntes.',
            'Disfruto realizar experimentos para entender conceptos.',
            'Prefiero hacer preguntas y discutir ideas en grupo.',
            'Me siento cómodo aprendiendo a través de lecturas extensas.',
            'Los gráficos y esquemas son esenciales para mi comprensión.',
            'Prefiero aprender haciendo preguntas directamente a un profesor.',
            'Las simulaciones o juegos interactivos son útiles para mi aprendizaje.',
            'Entiendo mejor cuando organizo la información en listas o cuadros.',
            'Prefiero repetir en voz alta lo que estoy aprendiendo.',
            'Me resulta más fácil aprender con música o sonidos de fondo.',
            'Prefiero estudiar en silencio absoluto.',
            'Los debates me ayudan a comprender mejor los temas.',
            'Me gusta analizar problemas desde diferentes perspectivas.',
            'Aprendo mejor cuando tengo ejemplos concretos en mi vida diaria.',
            'Las tareas prácticas me ayudan a asimilar lo aprendido.',
            'Disfruto enseñar a otros lo que acabo de aprender.'
        ];

        //Insertamos preguntas y opciones
        foreach ($questions as $question_text) {
            $question = Question::create([
                'testId' => $test->testId,
                'question_text' => $question_text,
                'type' => 'multiple_choice'
            ]);

            $options = [
                ['optionText' => '1 - Nunca', 'isCorrect' => false, 'value' => 1],
                ['optionText' => '2 - Raramente', 'isCorrect' => false, 'value' => 2],
                ['optionText' => '3 - Ocasionalmente', 'isCorrect' => false, 'value' => 3],
                ['optionText' => '4 - Usualmente', 'isCorrect' => false, 'value' => 4],
                ['optionText' => '5 - Siempre', 'isCorrect' => false, 'value' => 5],
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
