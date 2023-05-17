<template>
    <table-render :path_param="['queuing', 'ticket_log']" title="Ticket Log" :table_fields="table_fields">
        <template #header>
            <th-render>Ticket</th-render>
            <th-render>Attendant</th-render>
        </template>
        <template #body="{ item }">
            <td>{{ item.ticket_id__queuing_ticket__number }}</td>
            <td>{{ item.attendant_id__queuing_attendant__name }}</td>
        </template>

    </table-render>
</template>

<script>
export default {
    data() {
        return {
            table_fields: [
                'ticket_id__queuing_ticket__number', 'attendant_id__queuing_attendant__name'
            ]

        };
    },
};
</script>
