<template>
     <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a v-bind:href="root_url" class="brand-link">
            <img src="https://adminlte.io/themes/v3/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                style="opacity: .8">
            <span class="brand-text font-weight-light">AdminLTE 3</span>
        </a>

        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="javascript:void(0)" class="d-block">{{ user_name }}</a>
                </div>
            </div>

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a v-bind:href="root_url+'/dashboard'" class="nav-link">
                            <i class="nav-icon fa-solid fa-chalkboard"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a v-bind:href="root_url+'/tasks'" class="nav-link">
                            <i class="nav-icon fa-solid fa-list-check"></i>
                            <p>Tasks</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void(0)" @click="modalPassword" class="nav-link">
                            <i class="nav-icon fa fa-key"></i>
                            <p>Change Password</p>
                        </a>
                    </li>
                    <li class="nav-item fixed-bottom">
                        <a v-bind:href="root_url+'/logout'" class="nav-link">
                            <i class="nav-icon fa-solid fa-right-from-bracket"></i>
                            <p>Logout</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>
    <div id="variable_1"></div>
</template>

<script>
    export default {
        name: 'sidebar-component',
        props: ['user_name', 'root_url', '_token'],

        methods: {
            modalPassword () {
                customJs.runLoader('load')
                
                $.ajax({
                    type:"POST",
                    url: "ajax/modal-password",
                    data: {
                        '_token': this._token,
                    }
                }).done((response) => {
                    $("#variable_1").html(response)
                    this.pwModal = new Modal(document.getElementById('modal-password'), { keyboard: false })
                    this.pwModal.show();
                    customJs.closeLoader()
                });
            }
        }
    }
</script>
