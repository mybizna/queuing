<template>
    <table-render :path_param="['queuing', 'ticket']" title="Ticket" :table_fields="table_fields">
        <template #header>
            <th-render>Number</th-render>
            <th-render>Attendant</th-render>
        </template>
        <template #body="{ item }">
            <td>{{ item.number }}</td>
            <td>{{ item.attendant_id__queuing_attendant__name }}</td>
        </template>

    </table-render>
</template>

<script>
export default {
    data() {
        return {
            table_fields: [
                'number', 'attendant_id__queuing_attendant__name'
            ]

        };
    },
};
</script>
