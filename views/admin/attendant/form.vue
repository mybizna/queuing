<template>
    <edit-render :path_param="['queuing', 'attendant']" :model="model">
        <div class="row">
            <div class="col-md-6">
                <FormKit v-model="model.id" label="Id" id="id" type="hidden" validation="required" />
                <FormKit v-model="model.name" label="Name" id="name" type="text" validation="required" />
                <FormKit v-model="model.destination_id" label="Destination" id="destination_id" type="text"
                    validation="required" />
            </div>
            <div class="col-md-6">
                <FormKit v-model="model.description" label="Description" id="description" type="text"
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
                name: "",
                description: "",
                destination_id: "",
            },

        };
    }
};
</script>
