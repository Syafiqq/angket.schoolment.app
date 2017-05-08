#!/usr/bin/env bash
counselor_php=(
    "../../views/dashboard/view/counselor-view-dashboard.php"
    "../../views/inventory/add/counselor-add-inventory.php"
    "../../views/inventory/edit/counselor-edit-inventory.php"
    "../../views/inventory/view/counselor-view-inventory.php"
    "../../views/profile/edit/counselor-edit-profile.php"
    "../../views/profile/view/counselor-view-profile.php"
    "../../views/report/publish/counselor-publish-report.php"
    "../../views/student/report/counselor-report-student.php"
    "../../views/student/view/counselor-view-student.php"
)

counselor_js=(
    "../../js/dashboard/view/counselor-view-dashboard.js"
    "../../js/inventory/add/counselor-add-inventory.js"
    "../../js/inventory/edit/counselor-edit-inventory.js"
    "../../js/inventory/view/counselor-view-inventory.js"
    "../../js/profile/edit/counselor-edit-profile.js"
    "../../js/profile/view/counselor-view-profile.js"
    "../../js/report/publish/counselor-publish-report.js"
    "../../js/student/report/counselor-report-student.js"
    "../../js/student/view/counselor-view-student.js"
)

counselor_css=(
    "../../css/dashboard/view/counselor-view-dashboard.css"
    "../../css/inventory/add/counselor-add-inventory.css"
    "../../css/inventory/edit/counselor-edit-inventory.css"
    "../../css/inventory/view/counselor-view-inventory.css"
    "../../css/profile/edit/counselor-edit-profile.css"
    "../../css/profile/view/counselor-view-profile.css"
    "../../css/report/counselor-publish-report.css"
    "../../css/student/report/counselor-report-student.css"
    "../../css/student/view/counselor-view-student.css"
)


student_php=(
    "../../views/dashboard/view/student-view-dashboard.php"
    "../../views/inventory/result/student-result-inventory.php"
    "../../views/inventory/test/student-test-inventory.php"
    "../../views/inventory/view/student-view-inventory.php"
    "../../views/profile/edit/student-edit-profile.php"
    "../../views/profile/view/student-view-profile.php"
    "../../views/report/display/student-display-report.php"
)

student_js=(
    "../../js/dashboard/view/student-view-dashboard.js"
    "../../js/inventory/result/student-result-inventory.js"
    "../../js/inventory/test/student-test-inventory.js"
    "../../js/inventory/view/student-view-inventory.js"
    "../../js/profile/edit/student-edit-profile.js"
    "../../js/profile/view/student-view-profile.js"
    "../../js/report/display/student-display-report.js"
)

student_css=(
    "../../css/dashboard/view/student-view-dashboard.css"
    "../../css/inventory/result/student-result-inventory.css"
    "../../css/inventory/test/student-test-inventory.css"
    "../../css/inventory/view/student-view-inventory.css"
    "../../css/profile/edit/student-edit-profile.css"
    "../../css/profile/view/student-view-profile.css"
    "../../css/report/display/student-display-report.css"
)

for array_item in "${counselor_php[@]}"
do
    eval "ln -s ${array_item} ./counselor/php"
done
for array_item in "${counselor_js[@]}"
do
    eval "ln -s ${array_item} ./counselor/js"
done
for array_item in "${counselor_css[@]}"
do
    eval "ln -s ${array_item} ./counselor/css"
done
for array_item in "${student_php[@]}"
do
    eval "ln -s ${array_item} ./student/php"
done
for array_item in "${student_js[@]}"
do
    eval "ln -s ${array_item} ./student/js"
done
for array_item in "${student_css[@]}"
do
    eval "ln -s ${array_item} ./student/css"
done