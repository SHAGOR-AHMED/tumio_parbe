<div class="my_menu" style="border:1px dotted #e2e2e2;padding: 10px;">
    <?php
        $studentId = Session::get('studentId');
    ?>
    <ul>
        <li class="active"><a href="{{ url('my-account') }}" title="Dashboard">Dashboard</a></li>
        <li><a href="{{ url('our-courses') }}" title="Course">Course</a></li>
        <li><a href="{{ url('our-batches') }}" title="Batch">Batch</a></li>
        <li><a href="{{ url('my-course/'.encrypt($studentId)) }}" title="My Course">My Course</a></li>
        <li><a href="{{ url('edit-my-profile/'.encrypt($studentId)) }}" title="My Profile">My Profile</a></li>
    </ul>
</div>

<style>
    .my_menu ul{
        list-style: none;
        line-height: 40px;
    }

    .my_menu ul li{
        background-color: #123342;
        text-align: center;
        margin:5px;
    }

    .my_menu ul li:hover{
        background-color: #2da2bf;
    }

    .my_menu ul li .active{
        background-color: #ff0000;
    }

    .my_menu ul li a{
        color:#fff;
    }
</style>