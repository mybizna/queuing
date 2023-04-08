<template>
    <table-render :path_param="['queuing', 'destination']" title="Destination" :table_fields="table_fields">
        <template #header>
            <th-render>Name</th-render>
            <th-render>Description</th-render>
            <th-render>Assigned</th-render>
        </template>
        <template #body="{ item }">
            <td>{{ item.name }}</td>
            <td>{{ item.description }}</td>
            <td>{{ item.assigned }}</td>
        </template>

    </table-render>
</template>

<script>
export default {
    data() {
        return {
            table_fields: [
                'name', 'description', 'assigned'
            ]

        };
    },
};
</script>
