<div style="border:1px dotted #e2e2e2;padding: 10px;">
    <?php
        $studentId = Session::get('studentId');
    ?>
    <ul style="list-style: none;line-height: 40px;">
        <li style="background-color: #e2e2e2; text-align: center;margin:5px;"><a href="{{ url('my-account') }}" title="Dashboard">Dashboard</a></li>
        <li style="background-color: #e2e2e2; text-align: center;margin:5px;"><a href="{{ url('our-courses') }}" title="Course">Course</a></li>
        <li style="background-color: #e2e2e2; text-align: center;margin:5px;"><a href="{{ url('our-batches') }}" title="Batch">Batch</a></li>
        <li style="background-color: #e2e2e2; text-align: center;margin:5px;"><a href="{{ url('my-course/'.encrypt($studentId)) }}" title="My Course">My Course</a></li>
        <li style="background-color: #e2e2e2; text-align: center; margin:5px;"><a href="{{ url('edit-my-profile/'.encrypt($studentId)) }}" title="My Profile">My Profile</a></li>
    </ul>
</div>