<section class="s-team">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="titleh3 wow fadeInUp">Команда экспертов Sport<span>Casta</span></h3>
            </div>
        </div>
    </div>
    <div class="team-container clearfix">
        <?php 
//        $team = [
//            [
//                'name' => 'Александр',
//                'lastname' => 'Довгич',
//                'category' => 'Фитнес эксперт',
//                'img' => 'trener1.jpg',
//            ],
//            [
//                'name' => 'Елена',
//                'lastname' => 'Горкун',
//                'category' => 'Психолог',
//                'img' => 'trener2.jpg',
//            ],
//            [
//                'name' => 'Кристина',
//                'lastname' => 'Шевченко',
//                'category' => 'Диетолог',
//                'img' => 'trener3.jpg',
//            ],
//            [
//                'name' => 'Лилия',
//                'lastname' => 'Савох',
//                'category' => 'Фитнес эксперт',
//                'img' => 'trener4.jpg',
//            ],
//            [
//                'name' => 'Юрий',
//                'lastname' => 'Бардашевский',
//                'category' => 'Физический терапевт',
//                'img' => 'trener5.jpg',
//            ],
//            [
//                'name' => 'Артур',
//                'lastname' => 'Янковский',
//                'category' => 'Фитнес эксперт',
//                'img' => 'trener6.jpg',
//            ],
//            [
//                'name' => 'Екатерина',
//                'lastname' => 'Глушко',
//                'category' => 'Фитнес эксперт',
//                'img' => 'trener7.jpg',
//            ],
//            [
//                'name' => 'Алексей',
//                'lastname' => 'Соловьев',
//                'category' => 'Фитнес эксперт',
//                'img' => 'trener10.jpg',
//            ],
//            [
//                'name' => 'Зинаида',
//                'lastname' => 'Бондаренко',
//                'category' => 'Фитнес эксперт',
//                'img' => 'trener11.jpg',
//            ],
//        ];
        ?>
        <div class="team-member-big owl-carousel owl-theme">
        @for($i = 0, $y = 1; $i < count($team); $i++, $y++)
            <div class="team-member" id="member{{ $y }}">
                <div class="mask">
                    <img src="/user/{{ $team[$i]['user']['image'] }}" alt="{{ $team[$i]['user']['name'] . ' ' . $team[$i]['user']['lastname'] }}" class="team-member_img">
                </div>
                <div class="team-member_descr">
                    <p class="team-member_name">{{ $team[$i]['user']['name'] }} <br>{{ $team[$i]['user']['lastname'] }}</p>
                    <p class="team-member_text">{{ $team[$i]['category']['name'] }}</p>
                </div>
            </div>

        @endfor
        </div>
    </div>
</section>