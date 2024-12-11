<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>{{$title}}</title>
</head>
<style>
    html{
        height:100%;
    }
    body{
        height: 100%;
    }
    #wrapper {
        display: flex;
        height: 100%;
        overflow-x: hidden;
    }

    #sidebar-wrapper {
        flex-shrink: 0;
        transition: all 0.3s ease-in-out;
    }

    #sidebar-wrapper.active {
        margin-left: -250px; /* Adjust based on sidebar width */
    }

    @media (max-width: 768px) {
        #sidebar-wrapper {
            position: absolute;
            z-index: 1000;
            height: 100%;
            width: 250px;
            transition: all 0.3s ease-in-out;
            margin-left: -250px; /* Hidden by default on smaller screens */
        }

        #sidebar-wrapper.active {
            margin-left: 0; /* Visible when active */
        }

        #close-sidebar {
            display: block;
        }
    }

    @media (min-width: 769px) {
        #close-sidebar {
            display: none;
        }
    }
</style>
<body>
