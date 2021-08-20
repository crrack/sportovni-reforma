<!DOCTYPE html>
<html>
    <head>
        <title>An Error Occurred: 500</title>
        <style>
            body { 
                background-color: #fff; 
                margin: 0;
            }
            .container { 
                padding-top: 32px;
                margin: 0 auto; 
                max-width: 600px;
                font: 16px/1.5 -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; 
                color: #222;
            }
            .error-h1 { 
                color: #164194; 
                font-size: 24px;
                font-weight: bold;
                margin-bottom: 18px;
            }
            .error-h2 { 
                font-size: 18px;
                font-weight: bold;
                margin-bottom: 12px;
            }
            .error-link {
                color: #fff;
                background: #164194;
                padding: 16px 32px;
                display: inline-block;
                margin-top: 24px;
                text-decoration: none;
                font-weight: medium;
            }
        </style>
    </head>
    <body>
        <div
            x-data="{
                init() {
                    document.title = '404 Stránka nebyla nalezena';
                }
            }"
            x-init="init()"
            class="container"
        >
            <h1 class="error-h1">404 Stránka nebyla nalezena</h1>
            <h2 class="error-h2">Vypadá to, že jsme nenašli stránku kterou chcete vidět.</h2>

            <p>
                Pod touto adresou neexistuje žadný obsah. Nejspíše je to způsobeno tím, že jste na špatné adrese.
            </p>

            <a class="error-link" href="/">Hlavní stránka</a>
        </div>
    </body>
</html>
