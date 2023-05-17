<template>
    <table-render :path_param="['queuing', 'attendant']" title="Attendant" :table_fields="table_fields">
        <template #header>
            <th-render>Name</th-render>
            <th-render>Destination</th-render>
        </template>
        <template #body="{ item }">
            <td>{{ item.name }}</td>
            <td>{{ item.destination_id__queuing_destination__name }}</td>
        </template>

    </table-render>
</template>

<script>
export default {
    data() {
        return {
            table_fields: [
                'name', 'description', 'destination_id__queuing_destination__name'
            ]

        };
    },
};
</script>
