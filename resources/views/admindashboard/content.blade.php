<div>
    <div class="informations">
        <div class="totalstudents">
            <div class="items">
                <h6> Total Students </h6>
                <h6> {{ $studentinfo->count() }} </h6>
            </div>
            <div>
                <i class="fa-solid fa-user-group"></i>
            </div>
        </div>

        <div class="totalfaculties">
            <div class="items">
                <h6> Total Faculties </h6>
                <h6> {{ $total_faculty_count }} </h6>
            </div>
            <div>
                <i class="fa-solid fa-building"></i>
            </div>
        </div>

        <div class="totalsubjects">
            <div class="items">
                <h6> Total Subjects </h6>
                <h6> {{ $total_subject_count }} </h6>
            </div>
            <div>
                <i class="fa-solid fa-book"></i>
            </div>
        </div>
    </div>
</div>