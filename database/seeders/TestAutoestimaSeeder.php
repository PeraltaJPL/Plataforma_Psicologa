<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Test;
use App\Models\Question;
use App\Models\Option;

class TestAutoestimaSeeder extends Seeder
{
    public function run(): void
    {
        // Crear el test
        $test = Test::create([
            'name' => 'Test de Autoestima',
            'description' => 'Realiza el siguiente test para evaluar y comprobar tu nivel de autoestima. Contesta con la mayor sinceridad posible a cada una de las siguientes preguntas eligiendo la respuesta que más se identifique con tu forma de pensar o de actuar:',
            'guide' => 'Seleccione la opción que mejor lo represente: A, B, C o D.'
        ]);

        // Preguntas y opciones del test
        $questions = [
            [
                'question_text' => 'A la hora de tomar decisiones en tu vida, como proponer cosas nuevas en el trabajo, iniciar alguna actividad de ocio, o elegir un color nuevo para pintar tu casa, ¿sueles buscar la aprobación o el apoyo de las personas que te rodean?',
                'options' => [
                    ['text'=>'A - No, consideras que tu opinión sea buena y que la de los demás no tenga por qué serlo siempre.', 'value'=>4],
                    ['text'=>'B - Sí, pero sólo ante las decisiones que consideras demasiado importantes como para actuar precipitadamente.', 'value'=>2],
                    ['text'=>'C - Sí, siempre que puedes consultas con los demás. Te equivocas con frecuencia y quieres hacer las cosas bien.', 'value'=>1],
                    ['text'=>'D - Depende de la decisión. Sueles tener claro lo que vas a hacer, pero consideras las posibilidades que te ofrecen los demás.', 'value'=>3],
                ]
            ],
            [
                'question_text' => 'Imagina que estás en una reunión social o familiar importante; adviertes que no vas vestido para la ocasión y desentonas con los demás, ¿cómo te comportas?',
                'options' => [
                    ['text'=>'A - No le das importancia, te comportas con naturalidad y si alguien te lo comenta haces alguna broma al respecto.', 'value'=>3],
                    ['text'=>'B - Te da mucha vergüenza. Procuras situarte en algún lugar discreto y pasar desapercibido.', 'value'=>1],
                    ['text'=>'C - Te sientes incómodo pero tratas de no pensar en ello, te integras en la reunión y das alguna excusa por tu error.', 'value'=>4],
                    ['text'=>'D - No te importa nada en absoluto, aunque no lleves la ropa adecuada tienes estilo y sabes llevar bien cualquier cosa.', 'value'=>1],
                ]
            ],
            [
                'question_text' => 'Tienes muchas ganas de irte a comprar ropa y le pides a algún amigo que te acompañe. Esta persona es más alta y más atractiva que tú, y todo lo que se prueba le queda mucho mejor que a ti.',
                'options' => [
                    ['text'=>'A - Admiras el estilo de tu acompañante, al final compras un par de prendas necesarias pero muy simples en cuanto a forma y color.', 'value'=>2],
                    ['text'=>'B - No estás dispuesto a que te gane, decides comprar varias prendas muy modernas y bastante caras.', 'value'=>4],
                    ['text'=>'C - Admiras su estilo pero eres muy consciente del tuyo, compras la ropa que mejor te sienta y que necesitas, y pasáis un rato ameno probándoos cosas diferentes.', 'value'=>3],
                    ['text'=>'D - A su lado te sientes bastante poca cosa, te quita las ganas de probarte nada y mucho menos de comprar. Pones una excusa y te marchas.', 'value'=>1],
                ]
            ],
            [
                'question_text' => 'Un día conoces a alguien nuevo y muy interesante, estáis charlando animadamente y llega el momento de hablar de ti, ¿cuál de las siguientes opciones mejor se ajusta a lo que cuentas?',
                'options' => [
                    ['text'=>'A - No crees que tengas mucho que contar, tu trabajo es muy corriente, tus amigos son normales y tus aficiones también. Prefieres que esta persona te cuente su vida.', 'value'=>1],
                    ['text'=>'B - Tu trabajo te gusta y aunque sea corriente, siempre lo enfocas desde una perspectiva interesante, tus aficiones son tu pasión y disfrutas hablando de ellas, también hablas de tus proyectos futuros.', 'value'=>3],
                    ['text'=>'C - Hablas en líneas generales de tu trabajo y de tus aficiones, sobre todo hablas de tus amigos y de lo más interesante de sus vidas.', 'value'=>2],
                    ['text'=>'D - Más que de tu trabajo actual, hablas de tus proyectos y de tus objetivos, y de lo que vas a hacer para logrados, de lo buenas que son tus amistades y lo poco usual de tus aficiones. Te gusta hablar de ti.', 'value'=>4],
                ]
            ],
            [
                'question_text' => 'En tu lugar de trabajo o de estudios, se está explicando algo que es completamente nuevo para ti. Llega un momento en que te das cuenta que no has entendido casi nada ¿qué haces?',
                'options' => [
                    ['text'=>'A - Paras la explicación y requieres que se empiece de nuevo, si tu no lo entiendes habrá mucha gente que tampoco lo haga.', 'value'=>4],
                    ['text'=>'B - Si hay más gente que pregunte tu también lo haces, si no, buscas en un aparte al ponente para que te aclare las dudas.', 'value'=>2],
                    ['text'=>'C - Te da mucha vergüenza preguntar y demostrar así que no entiendes. Más tarde preguntarás a algún amigo o intentarás informarte por tu cuenta.', 'value'=>1],
                    ['text'=>'D - Tomas nota de lo que no entiendes para preguntarlo al finalizar la charla, si sigues con dudas pedirás información complementaria para prepararte mejor.', 'value'=>3],
                ]
            ],
            [
                'question_text' => 'Tener un trabajo bien remunerado y que nos guste es algo difícil de conseguir, si tuvieras que valorar tu empleo o tu situación laboral, ¿cómo la definirías?',
                'options' => [
                    ['text'=>'A - Satisfactoria, tratas de buscar el lado positivo de las cosas y nunca te faltan proyectos y objetivos que perseguir.', 'value'=>3],
                    ['text'=>'B - Horrible, no obstante, sabes que las cosas están mal y que tienes que aguantar lo que sea. Estás muy agradecido por tener trabajo.', 'value'=>1],
                    ['text'=>'C - No te preocupa especialmente el tema, tienes un montón de proyectos más importantes y con tu valía los alcanzarás.', 'value'=>4],
                    ['text'=>'D - Has logrado que no te afecte, consideras más importante tu vida personal y privada y eso es por lo que luchas.', 'value'=>2],
                ]
            ],
            [
                'question_text' => 'Has tenido un día duro, has trabajado con más ahínco para finalizar una tarea en la oficina, has hecho todas las gestiones que tenías pendientes, has resuelto un par de problemas domésticos y encima le has hecho un favor a un amigo. ¿Qué haces al llegar a casa?',
                'options' => [
                    ['text'=>'A - Prefieres no pensarlo, el día ha sido duro pero para ti no es algo nuevo, solo pides poder dormir bien y que mañana sea un día más tranquilo.', 'value'=>2],
                    ['text'=>'B - Se lo cuentas a todo el mundo, te gusta que se te reconozca cuando haces las cosas bien y exiges en casa que te mimen por haberte esforzado tanto.', 'value'=>4],
                    ['text'=>'C - Estás muy satisfecho y decides darte un capricho, darte un baño de espuma y ver una buena película, o comprarte un regalito que hace tiempo querías.', 'value'=>3],
                    ['text'=>'D - Te preocupa que se te haya olvidado algo o haber hecho algo mal por la prisa, repasas mentalmente las actividades y al día siguiente esperas no tener queja de nadie.', 'value'=>1],
                ]
            ],
            [
                'question_text' => 'En tu trabajo están buscando a una persona que represente a la empresa en un concurso del ramo. Piden una persona que cumpla unos requisitos, entre ellos, explicar bien vuestro trabajo y que haga una demostración práctica del mismo.',
                'options' => [
                    ['text'=>'A - No te planteas ser voluntario, hay mil personas más capacitadas que tú para la demostración y no se te da bien hablar en público.', 'value'=>1],
                    ['text'=>'B - Te presentas voluntario, puede ser una experiencia interesante y si sales elegido puedes hacer una presentación innovadora.', 'value'=>3],
                    ['text'=>'C - No te presentas, serías capaz de hacerla bien pero crees que hay gente mejor preparada y más original que tú.', 'value'=>2],
                    ['text'=>'D - Te presentas y estás casi seguro de que te elegirán, haces buenos proyectos y darás una buena imagen de la empresa.', 'value'=>4],
                ]

            ],
            [
                'question_text' => '¿Con cuál de las siguientes frases sobre la buena fortuna estás más de acuerdo?',
                'options' => [
                    ['text'=>'A - La buena suerte puede tocarle a todo el mundo, yo me considero una persona afortunada a la que la vida le sonríe.', 'value'=>4],
                    ['text'=>'B - Para tener buena suerte hay que trabajar duro, sólo los muy afortunados la tienen sin apenas esfuerzo.', 'value'=>2],
                    ['text'=>'C - Yo no tengo suerte, tanto los premios como las cosas especia les sólo les pasan a los demás.', 'value'=>1],
                    ['text'=>'D - La suerte respecto a los premios es una cuestión de probabilidad, y respecto a las cosas de la vida, siempre depende de cómo se perciban.', 'value'=>3],
                ]
            ],
            [
                'question_text' => 'En una fiesta en La que no conoces a nadie excepto a Los anfitriones, te presentan a un grupo de personas de aspecto interesante. ¿Cuál es tu actitud?',
                'options' => [
                    ['text'=>'A - Te interesa conocerlos no sólo para pasar un buen rato en la reunión sino porque puede ser una forma de iniciar una amistad.', 'value'=>3],
                    ['text'=>'B - Esperas causarles una buena impresión y decir cosas que les puedan interesar.', 'value'=>1],
                    ['text'=>'C - Te gustaría llevarles a tu terreno en la conversación para así poder hablar de los temas que más te interesan.', 'value'=>4],
                    ['text'=>'D - Antes de iniciar una conversación escuchas lo que dicen, y es peras para hablar a que lo hagan de temas que tú conozcas.', 'value'=>2],
                ]
            ]
        ];
        // Crear las preguntas y sus opciones
        foreach ($questions as $question_data) {
            $question = Question::create([
                'testId' => $test->testId,
                'question_text' => $question_data['question_text'],
                'type' => 'multiple_choice'
            ]);

            foreach ($question_data['options'] as $option_text) {
                Option::create([
                    'questionId' => $question->questionId,
                    'optionText' => $option_text['text'],
                    'value' => $option_text['value'],
                    'isCorrect' => false
                ]);
            }
        }
    }
}
