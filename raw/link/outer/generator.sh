#!/usr/bin/env bash
auth_css=(
    "../../../css/auth/login/counselor-login-auth.css"
    "../../../css/auth/login/student-login-auth.css"
    "../../../css/auth/recover/counselor-recover-auth.css"
    "../../../css/auth/recover/counselor-recover-confirm-auth.css"
    "../../../css/auth/recover/student-recover-auth.css"
    "../../../css/auth/recover/student-recover-confirm-auth.css"
    "../../../css/auth/register/counselor-register-auth.css"
    "../../../css/auth/register/student-register-auth.css"
)

auth_js=(
    "../../../js/auth/register/counselor-register-auth.js"
    "../../../js/auth/register/student-register-auth.js"
    "../../../js/auth/recover/student-recover-confirm-auth.js"
    "../../../js/auth/recover/student-recover-auth.js"
    "../../../js/auth/recover/counselor-recover-confirm-auth.js"
    "../../../js/auth/recover/counselor-recover-auth.js"
    "../../../js/auth/login/student-login-auth.js"
    "../../../js/auth/login/counselor-login-auth.js"
)

auth_php=(
    "../../../views/auth/login/student-login-auth.php"
    "../../../views/auth/login/counselor-login-auth.php"
    "../../../views/auth/recover/sutdent-recover-auth.php"
    "../../../views/auth/recover/student-recover-confirm-auth.php"
    "../../../views/auth/recover/counselor-recover-confirm-auth.php"
    "../../../views/auth/recover/counselor-recover-auth.php"
    "../../../views/auth/register/counselor-register-auth.php"
    "../../../views/auth/register/student-register-auth.php"

)

create_symlink () {
    cd $1
    declare -a _items=("${!2}")
    for array_item in "${_items[@]}"
    do
        filename="${array_item##*/}"
        eval "ln -s ${array_item} $filename"
    done
    cd $3
}

create_symlink "php/" auth_php[@] "../"
create_symlink "css/" auth_css[@] "../"
create_symlink "js/" auth_js[@] "../"
