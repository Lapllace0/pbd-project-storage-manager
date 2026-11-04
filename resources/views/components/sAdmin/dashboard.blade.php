<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/SAdmin.css'])
</head>

<body>
    <div class="navbar">
    </div>
    <div class="layout-container">
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"
            id="svg-a">
            <path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z" />
        </svg>
        <aside class="sidebar" id="sidebar">
            <livewire:sidebar />
        </aside>

        <main class="main-content">
            @livewire('container')
        </main>
    </div>

    <script>
        let data = document.getElementById('svg-a')
        let sidebar = document.getElementById('sidebar')

        data.addEventListener('click', () => {
            if (sidebar.style.display != 'none') {
                sidebar.style.display = 'none'
            } else {
                sidebar.style.display = 'block'
            }

        })


    </script>
</body>

</html>
