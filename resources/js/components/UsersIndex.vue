<template>
    <div>
        <div class="row mt-4">
            <div class="col-sm-6 offset-6">
                <input
                    v-model="search"
                    type="search"
                    class="form-control"
                    placeholder="Search by name,email or type..."
                />
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-sm-12">
                <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>
                            Full Name
                        </th>
                        <th>
                            Email
                        </th>
                        <th>
                            Last Logged In
                        </th>
                        <th>
                            Authorized
                        </th>
                        <th>
                            User Type
                        </th>
                    </tr>

                    <tr v-for="user in users.data" :key="user.id">
                        <td>{{ user.name }}</td>
                        <td>{{ user.email }}</td>
                        <td>{{ user.last_logged_at }}</td>
                        <td>{{ user.authorized_at }}</td>
                        <td>
                            <button class="btn btn-danger btn-md">
                                {{ user.type }}
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-sm-6 offset-6">
                <pagination :data="users" @pagination-change-page="getUsers"></pagination>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            users: {},
            paginate : 10,
            search : "",
        }
    },
    watch:{
        paginate: function(value){
            this.getUsers();
        }
    },
    methods: {
        getUsers(page = 1){
            axios.get('/api/users?page='+ page + '&paginate=' + this.paginate)
            .then(response => {
                this.users = response.data;
            });
        }
    },
    mounted(){
        this.getUsers();
    }
};

</script>
