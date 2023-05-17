<template>
    <edit-render :path_param="['queuing', 'attendant']" :model="model">
        <div class="row">
            <div class="col-md-6">
                <FormKit v-model="model.id" label="Id" id="id" type="hidden" validation="required" />
                <FormKit v-model="model.name" label="Name" id="name" type="text" validation="required" />
                <FormKit label="Destination" button_label="Select Destination" id="destination_id" type="recordpicker"
                    comp_url="queuing/admin/destination/list.vue" :setting="setting.destination_id"
                    v-model="model.destination_id" validation="required" inner-class="$reset formkit-inner"
                    wrapper-class="$reset formkit-wrapper" />
            </div>
            <div class="col-md-6">
                <FormKit v-model="model.description" label="Description" id="description" type="textarea"
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
            setting: {
                destination_id: {
                    path_param: ["queuing", "destination"],
                    fields: ['name', 'slug'],
                    template: '[name] - [slug]',
                },
            },

        };
    }
};
</script>
