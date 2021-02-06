<link rel="stylesheet" href="{{ asset('theme/node_modules/select2/dist/css/select2.min.css') }}">
<style>
    .dropdown-toggle::after {
    display: none !important;
}
.dropleft .dropdown-toggle::before {
    display: none !important;
    }
.table:not(.table-sm) thead th {
    background-color: #d2ddfd;
    color: #242425;
}
.table td{
    vertical-align: unset;
    padding-top: 5px;
    padding-bottom:5px;
}
.section {
    position: relative;
    z-index: unset;
}
</style>
@include('global.custom-style')