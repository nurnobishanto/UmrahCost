export default {
    methods: {
        route,
        indexing(pagination, index) {
            return (
                pagination.per_page * (pagination.current_page - 1) + index + 1
            );
        },

        // hasPermission(key) {
        //     return (this.permissions.hasOwnProperty(key) && this.permissions[key]);
        // },
        // hasAnyPermission(array) {
        //     return array.some((v) =>
        //         Object.keys(this.permissions)
        //             .filter((k) => this.permissions[k])
        //             .includes(v)
        //     );
        // },

        hasAnyPermission: function (permissions) {

            var allPermissions = this.$page.props.auth.can;
            var hasPermission = false;

            // permissions.forEach(function(item){
            //   if(allPermissions[item]) hasPermission = true;
            // });
            return hasPermission;
          },


    },
    computed: {
        permissions() {
            return JSON.parse(this.$page.props.permission);
        }
    }
};
