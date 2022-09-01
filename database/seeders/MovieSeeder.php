<?php

namespace Database\Seeders;

use App\Enums\MovieRating;
use App\Models\Director;
use App\Models\Movie;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Director::factory()->with(
            'James McTeigue',
            asset('assets/director-portraits/james-mcteigue.png'),
        )->create();

        $stevenSpielberg = Director::factory()->with(
            'Steven Spielberg',
            asset('assets/director-portraits/steven-spielberg.jpg'),
        )->create();

        $movies = [
            [
                'name' => 'Star Wars: The Empire Strikes Back',
                'rating' => MovieRating::PG,
                'released_on' => '1980-05-21',
                'poster_url' => asset('assets/movie-posters/the-empire-strikes-back.jpg'),
                'runtime' => '124 min',
                'plot' => <<<'TXT'
                Snow. Big metal dogs. Oh, there's that kid from the last one! A green puppet, but not Kermit.
                Boba Fett? Boba Fett? Where? Damn. Too late, he got him. Oh nice! Laser swords. Hold my popcorn,
                I'm being chased by a nerd in a Chewbacca outfit. Apparently it's lightsaber - my bad. Wait, he's
                his what now?!?
                TXT,
                'director_id' => Director::factory()->with(
                    'Irvin Kershner',
                    asset('/assets/director-portraits/irvin-kershner.jpg'),
                ),
            ],
            [
                'name' => 'Back To The Future',
                'rating' => MovieRating::PG_13,
                'released_on' => '1985-07-03',
                'poster_url' => asset('assets/movie-posters/back-to-the-future.jpg'),
                'runtime' => '116 mins',
                'plot' => <<<'TXT'
                I mean come on, that's totally unrealistic. I'm not being funny, but it just isn't believable. There's no way that's how
                it would actually work in real life. You're telling me that if I turn my amp up that loud, I'll go flying across the room?
                Oh, there are DeLoreans in it too. And Flux Capacitors. But that guitar amp just makes the whole thing unbelievable.
                TXT,
                'director_id' => Director::factory()->with(
                    'Robert Zemeckis',
                    asset('assets/director-portraits/robert-zemeckis.jpg'),
                ),
            ],
            [
                'name' => 'The \'Burbs',
                'rating' => MovieRating::PG_13,
                'released_on' => '1989-02-17',
                'poster_url' => asset('assets/movie-posters/the-burbs.jpg'),
                'runtime' => '101 mins',
                'plot' => <<<'TXT'
                Tom Hanks and Carrie Fisher in one movie? Nice! Thinking about it, most of my in-jokes stem from this movie.
                "It was a foaming squirrel", "Pretty girl, friend of yours?", "I called the pizza dude!" and "Yo, Rumsfield!" are
                all frequented phrases in our house.
                TXT,
                'director_id' => Director::factory()->with(
                    'Joe Dante',
                    asset('assets/director-portraits/joe-dante.jpg')
                ),
            ],
            [
                'name' => 'Hook',
                'rating' => MovieRating::PG,
                'released_on' => '1991-12-11',
                'poster_url' => asset('assets/movie-posters/hook.png'),
                'runtime' => '142 mins',
                'plot' => <<<'TXT'
                A workaholic who misses important events in his family life? Should've used Laravel. Wait, that's no ordinary middle-aged man,
                that's Peter Pan! What happened to him?!? That's what raising kids will do to you, I guess. Wouldn't it be great to have
                pixie dust in real life? Maybe that's how DALL-E 2 works. I'm not crying, you're crying.
                TXT,
                'director_id' => $stevenSpielberg,
            ],
            [
                'name' => 'Jurassic Park',
                'rating' => MovieRating::PG_13,
                'released_on' => '1993-06-09',
                'poster_url' => asset('assets/movie-posters/jurassic-park.jpg'),
                'runtime' => '127 mins',
                'plot' => <<<'TXT'
                Although the science of this sounds somewhat plausible, I'm sad to tell you that it is also fundamentally flawed. At a push, DNA
                lasts ~6.8 million years according to scientist's best estimates. So no amount of shiny yellow stuff with mosquitoes trapped
                inside is going to bring them back. Look, if you want to get angry, blame Steven, not me; he agreed to direct it. Gotta say,
                that bit with the T-Rex was really cool though.
                TXT,
                'director_id' => $stevenSpielberg,
            ],
            [
                'name' => 'Mission: Impossible',
                'rating' => MovieRating::PG_13,
                'released_on' => '1996-05-22',
                'poster_url' => asset('assets/movie-posters/mission-impossible.jpg'),
                'runtime' => '110 mins',
                'plot' => <<<'TXT'
                ...1 ,2 ,3 xp gmhcgltv eotl oopn
                tzkllti lprG !iuuF .xpkcG .ctgdumpotR .ljlki tmke tcuI .ljlki tmkE .zxpoptm k iuce lvxtmltv tlphcM iuG .rhv-rhv rhv-rhv rhv-rhv rhv-rhv
                rhv-rhv rhv-rhv rhv-rhv rhv-rhV .xp ljmpj mplhi titrG .ipr gchr g'xuv ,wvufwctst whz vuuz trg lp xkrgT ,uX !ltspo xkrgT ,gpkN .vktv ook tc'wtrg ,ru ...gp gdtmmk ug tluurm huw vohurl ,xupllpi chuW
                TXT,
                'director_id' => Director::factory()->with(
                    'Brian De Palma',
                    asset('assets/director-portraits/brian-de-palma.jpg'),
                ),
            ],
            [
                'name' => 'Titanic',
                'rating' => MovieRating::PG_13,
                'released_on' => '1997-11-01',
                'poster_url' => asset('assets/movie-posters/titanic.png'),
                'runtime' => '195 mins',
                'plot' => <<<'TXT'
                Every night in my dreams, I see you, I feel you. That is how I know you go on. Far across the distance,
                And spaces between us, You have come to show you go on. Near, far, wherever you are, I believe that the heart does go on.
                Once more, you open the door, And you're here in my heart, And my heart will go on and on.
                TXT,
                'director_id' => Director::factory()->with(
                    'James Cameron',
                    asset('assets/director-portraits/james-cameron.jpg'),
                ),
            ],
            [
                'name' => 'The Bourne Identity',
                'rating' => MovieRating::PG_13,
                'released_on' => '2002-06-06',
                'poster_url' => asset('assets/movie-posters/the-bourne-identity.jpg'),
                'runtime' => '119 mins',
                'plot' => <<<'TXT'
                What do you get if you cross James Bond with a nursing home resident? Jason Bourne! Join a spy who has some serious karate skills
                but can't for the life of him remember his name. Prepare to witness more quick cuts than Gordon Ramsey's kitchen knife, and camera
                shake so intense you'd think it'd been recorded by a kangaroo. Seriously though, great film.
                TXT,
                'director_id' => Director::factory()->with(
                    'Doug Liman',
                    asset('assets/director-portraits/doug-liman.JPG'),
                ),
            ],
        ];

        Movie::factory()->count(count($movies))->sequence(...$movies)->create();
    }
}
