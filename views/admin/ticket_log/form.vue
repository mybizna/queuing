<template>
    <edit-render :path_param="['queuing', 'ticket_log']" :model="model">

        <div class="row">
            <div class="col-md-6">
                <FormKit v-model="model.id" label="Id" id="id" type="hidden" validation="required" />
                <FormKit v-model="model.ticket_id" label="Ticket" id="ticket_id" type="text" validation="required" />
            </div>
            <div class="col-md-6">
                <FormKit v-model="model.attendant_id" label="Attendant" id="attendant_id" type="text"
                    validation="required" />
            </div>
        </div>
        
    </edit-render>
</template>

<script>
export default {
    data() {
        return {
            id: null,
            model: {
                id: "",
                ticket_id: "",
                attendant_id: "",
            },

            setting: {
                ticket_id: {
                    path_param: ["queuing", "ticket"],
                    fields: ['number'],
                    template: '[number]',
                },
                attendant_id: {
                    path_param: ["queuing", "attendant"],
                    fields: ['name', 'slug'],
                    template: '[name] - [slug]',
                },
            },

        };
    }
};
</script>
