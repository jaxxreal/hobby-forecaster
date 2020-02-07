<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
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
                padding-top: 65px;
                padding-bottom: 65px;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .form {
                display: flex;
                flex-direction: column;
            }

            .form > label {
                display: flex;
                justify-content: space-between;
                margin-bottom: 15px;
            }

            .form > label > input {
                margin-left: 15px;
            }

            .loader {
                opacity: 0;
                position: absolute;
                width: 100vw;
                height: 100vh;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0,0,0,0.6);
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-size: 20px;
                transition: all .3s ease;
                z-index: -1;
            }

            .loader.visible {
                z-index: 1;
                opacity: 1;
            }

            .button {
                display: inline-block;
                padding: 5px 20px;
                border-radius: 32px;
                box-sizing: border-box;
                text-decoration: none;
                color: #FFFFFF;
                background-color: #4eb5f1;
                text-align: center;
                transition: all 0.2s;
                line-height: 1.55;
                font-size: 16px;
                cursor: pointer;
            }

            .button:hover {
                background-color: #4095c6;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref">
            <div id="app" class="content">
                <form v-if="isFormVisible" v-on:submit.prevent="handleSubmit" class="form">
                    <label for="numberOfStudy">
                        Current Number of study per day
                        <input v-model="numberOfStudy" type="number" name="numberOfStudy" id="numberOfStudy" required>
                    </label>
                    <label for="growthPerMonth">
                        Number of Study Growth per month in %
                        <input v-model="growthPerMonth" type="number" name="growthPerMonth" id="growthPerMonth" required>
                    </label>
                    <label for="numberOfMonths">
                        Number of months to forecast
                        <input v-model="numberOfMonths" type="number" name="numberOfMonths" id="numberOfMonths" required>
                    </label>
                    <button class="button" type="submit">
                        Forecast
                    </button>
                </form>
                <forecast-table v-else v-bind:forecast="forecast"></forecast-table>
                <button class="button" v-if="!isFormVisible" v-on:click="isFormVisible = true">
                    Forecast again?
                </button>
                <div v-bind:class="{ visible: isLoadingData }" class="loader">
                    Loading<dots-loader/>
                </div>
            </div>
        </div>

        <script src="/js/app.js"></script>
    </body>
</html>
