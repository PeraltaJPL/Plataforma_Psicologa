<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Test;
use App\Models\Question;
use App\Models\Option;

class TestPsicometricoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Inserta encabezado del test, guía y descripción
        $test = Test::create([
            'name' => 'Test Psicométrico, Habilidades de Estudio',
            'description' =>
            "Este test está diseñado para ayudarle a identificar sus hábitos y habilidades relacionadas con el estudio y el aprendizaje. 
            Cada persona tiene una manera única de organizarse y afrontar los retos académicos, y reconocer estos patrones puede ser clave para mejorar su desempeño y aprovechar al máximo su tiempo de estudio.

            El objetivo de este test es brindarle una visión clara de sus fortalezas y áreas de oportunidad en diferentes aspectos del proceso de aprendizaje, 
            como el entorno de estudio, la planificación del tiempo, la atención, la toma de apuntes y las estrategias de estudio.",

            'guide' => 'Contesta SÍ o NO, para señalar tus hábitos a la hora de estudiar.'
        ]);

        $questions = [

            'Tienes un sitio fijo para estudiar',
            'Estudias en una habitación alejada de ruidos, TV, radio, etc',
            'Tienes luz suficiente',
            'Cuando te pones a estudiar, tienes a mano todo lo que necesitas',
            'Tienes un horario fijo de estudio',
            'Divides tu tiempo entre las asignaturas que tienes que estudiar',
            'Estudias como mínimo cinco días por semana',
            'En tu plan de estudios, incluyes ratos de descanso',
            'Miras al profesor cuando explica',
            'Tomas nota de las lecciones señaladas para estudiar y de los ejercicios a realizar',
            'Estás atento durante toda la explicación',
            'Preguntas cuando no entiendes alguna cuestión',
            'Participas bien en la actividad común de la clase',
            'Indicas la fecha en tus hojas de apuntes',
            'Tienes tus apuntes divididos por materias',
            'Anotas las palabras difíciles, tareas especiales, lo que no comprendes',
            'Revisas y completas los apuntes',
            'Subrayas las ideas importantes',
            'Haces una primera lectura de tus notas, cuando preparas un tema',
            'Tienes facilidad para encontrar las ideas básicas de lo que lees',
            'Cuando dudas del significado, ortografía o pronunciación de una palabra, consultas el diccionario',
            'Señalas lo que no entiendes',
            'Anotas los datos importantes o difíciles de recordar',
            'Cuando estudias, tratas de resumir mentalmente',
            'Empleas algún sistema especial para recordar datos',
            'Después de aprender una lección, la repasas',
            'Pides ayuda cuando encuentras alguna dificultad',
            'Llevas al día las asignaturas y los ejercicios',
            'Cuando te sientas a estudiar, te pones rápidamente a trabajar',
            'Cuando estudias, te marcas las tareas y las terminas',
            'Ante un dato geográfico desconocido, consultas los mapas',
            'Haces esquema de cada lección',
            'En los esquemas, incluyes la materia del libro y de los apuntes tomados en clase',
            'Empleas el menor número de palabras para hacer los esquemas',
            'Cuando una lección es difícil, la organizas a través de esquemas y guiones para hacerla más comprensible',
            'Destacan tus esquemas las ideas principales',
            'Consultas otros libros además del texto',
            'Antes de redactar un trabajo, haces un guión',
            'Compruebas ortografía y limpieza de lo que escribes',
            'Cuando haces un trabajo, pones el índice, un resumen del contenido y una reseña bibliográfica',
            'Te es fácil concentrarte cuando estudias',
            'Tienes preocupaciones ajenas al estudio que te perturban y disminuyen tu rendimiento',

        ];

        //Insertamos preguntas y opciones
        foreach ($questions as $question_text) {
            $question = Question::create([
                'testId' => $test->testId,
                'question_text' => $question_text,
                'type' => 'multiple_choice'
            ]);

            $options = [
                ['optionText' => 'Si', 'isCorrect' => false, 'value' => 1],
                ['optionText' => 'No', 'isCorrect' => false, 'value' => 0],
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
