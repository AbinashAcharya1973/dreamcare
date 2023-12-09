<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payout Generation</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
</head>

<body class="bg-gray-100 p-8">
    <div id="main">
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold mb-4">Payout Generation</h2>
        <!-- Form for Month and Year -->
        
            <div class="mb-4">
                <label for="month" class="block text-sm font-medium text-gray-700">Month</label>
                <select id="month" name="month" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:outline-none" v-model="pmonth">
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <!-- Add more months here -->
                </select>
            </div>
            <div class="mb-4">
                <label for="year" class="block text-sm font-medium text-gray-700">Year</label>
                <input type="number" id="year" name="year" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:outline-none" v-model="pyear"/>
            </div>
            <div class="text-center">
                <button type="submit" @click="getpayout" class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600">Generate Payout</button>
            </div>
        
    </div>

    <!-- Table for Expense Data -->
    <div class="max-w-md mx-auto mt-8 bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold mb-4">Payout Data</h2>
        <table class="min-w-full">
            <thead>
                <tr>
                    <th class="text-left">Member Code</th>
                    <th class="text-left">Name</th>
                    <th class="text-left">PShare</th>
                </tr>
            </thead>
            <tbody>
                <!-- Replace with dynamic data from your backend -->
                <tr v-for="rec in payouttb">
                    <td>{{rec.memid}}</td>
                    <td>{{rec.mname}}</td>
                    <td>{{rec.levelincome}}</td>
                </tr>
                
                <!-- Add more rows as needed -->
            </tbody>
        </table>
    </div>
    </div>
    <script>
        var app = new Vue({
            el: '#main',
            data: {
                payouttb:[],
                pmonth:'',
                pyear:''
            },            
            methods: {
                getpayout: function(){
                    axios.post("monthpayout.php",{m:this.pmonth,y:this.pyear})
                    .then(function(response){
                        app.payouttb=response.data;
                    })
                    .catch(function(error){
                        alert(error);
                    });
                }
            }
        });
    </script>
</body>

</html>