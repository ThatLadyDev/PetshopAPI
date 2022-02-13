<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                /*color: #636b6f;*/
                /*font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";;*/
                /*font-weight: 100;*/
                /*height: 100vh;*/
                margin: 0;
            }

            .error-wrapper {
                display: flex;
                flex-direction: column;
                height: 100vh;
                justify-content: center;
                align-items: center;
                padding: 0px 80px 0px 80px;
                font-family: 'Open Sans',sans-serif;
            }

            .error-box .error-title {
                margin-bottom: 1rem;
                font-size: 6em;
                color: #bcd;
            }

            .error-box .error-text {
                margin-bottom: 2rem;
                font-size: 1.25em;
                color: #1d2d3d;
                line-height: 1.5;
            }

            .error-box .btn-link {
                text-align: center;
                cursor: pointer;
                border: 1px solid transparent;
                padding: 0.5rem 1rem;
                font-size: 1rem;
                border-radius: 0.25rem;
                display: inline-block;
                background-color: #06c;
                color: #fff;
                text-decoration: none;
            }

            .error-box {
                margin: auto;
                text-align: center;
            }

            .error-box .error-title {
                margin-bottom: 1rem;
                font-size: 6em;
                color: #bcd;
            }

            .error-box .error-text {
                margin-bottom: 2rem;
                font-size: 1.25em;
                color: #1d2d3d;
                line-height: 1.5;
            }

            .error-img img {
                width: 360px;
                height: 246px;
                float: right;
            }

            .error-img {
                display: block;
                width: 100%;
                padding-right: 60px;
                padding-bottom: 40px;
            }

        </style>
    </head>
    <body>
        <div class="error-wrapper">
            <div class="error-box">
                <h1 class="error-title">@yield('code')</h1>
                <p class="error-text">@yield('message')</p>
                <a href="/" class="btn-link">Go to home page</a>
            </div>
            <div class="error-img">
                <img src="/assets/images/ice-cream.svg" alt="Error Image" >
            </div>
        </div>
    </body>
</html>
