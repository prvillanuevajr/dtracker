<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            p, .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    {{ config('app.name', 'Laravel') }}
                </div>

                <p class="links">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum deserunt illum similique! Deserunt ea, eos error excepturi illum quisquam saepe ut velit! Amet dolor id illo itaque maiores mollitia non quod tempore. Aliquid aperiam aut commodi corporis doloremque dolorum, ea eligendi, eum illo molestias, repellat vel. Nulla, similique, temporibus? Accusamus ad aliquam amet, debitis dolore error fuga hic inventore, ipsa iste laboriosam, maxime minima minus nam nobis odio odit officiis possimus praesentium quaerat quidem quos tenetur ut vitae voluptatum. Accusantium cum cumque delectus dignissimos dolore, eligendi enim mollitia nemo nesciunt obcaecati officiis perspiciatis placeat quia, quidem quisquam quod repellat reprehenderit similique sint soluta sunt tempore voluptas. A amet architecto aut consectetur consequuntur cupiditate dolorum esse, excepturi fugit ipsa molestias nemo provident quas qui quia quibusdam quod quos repellendus! Blanditiis deserunt dolores, illo maiores minima quos similique voluptate voluptates. Ad, alias asperiores blanditiis consequatur doloribus facere fuga inventore magnam, minus natus, nemo optio praesentium quaerat quasi reiciendis vero vitae voluptas. Aliquam atque blanditiis dolore dolorum esse libero non perspiciatis placeat provident, qui sunt tempora voluptatum. Deleniti distinctio doloribus esse est exercitationem expedita harum nemo nesciunt omnis possimus quae quam repellendus rerum, sed sunt temporibus ut. Aliquid dignissimos earum esse nobis ullam.
                </p>
            </div>
        </div>
    </body>
</html>
