<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <nav>
                <ul class="list-inline">
                    <li>
                        <router-link to="/">Home</router-link>
                    </li>
                    <li v-if="!$auth.check()" class="pull-right" >
                        <router-link to="/admin/login">Login</router-link>
                    </li>
                    <li v-if="!$auth.check()" class="pull-right">
                        <router-link to="/register">Register</router-link>
                    </li>
                    <li v-if="$auth.check()" class="pull-right">
                        <a href="#" @click.prevent="$auth.logout()">Logout</a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="panel-body">
            <router-view></router-view>
        </div>
    </div>
</template>
