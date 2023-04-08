<template>
    <table-render :path_param="['queuing', 'ticketlog']" title="Ticket Log" :table_fields="table_fields">
        <template #header>
            <th-render>Ticket</th-render>
            <th-render>Attendant</th-render>
        </template>
        <template #body="{ item }">
            <td>{{ item.ticket_id }}</td>
            <td>{{ item.description }}</td>
        </template>

    </table-render>
</template>

<script>
export default {
    data() {
        return {
            table_fields: [
                'ticket_id', 'attendant_id'
            ]

        };
    },
};
</script>
