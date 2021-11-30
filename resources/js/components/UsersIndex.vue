<template>
    <div>
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
                        <button class="btn btn-danger btn-sm">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    data(){
        return {
            users: {},
        }
    },
    mounted(){
        axios.get('/api/users')
            .then(response => {
                this.users = response.data;
            });
    }
};

</script>
