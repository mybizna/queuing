<template>
    <div class="row m-2">
sdsdfsdf
        <div v-if="featured_package.id"
            class=" shadow-xl rounded-md bg-gradient-to-br from-pink-500 via-red-900 to-pink-700 hover:from-pink-500  hover:via-red-900  hover:to-yellow-900 sm:ml-2 m-1">

            <div class="h-40">
                <h3 class="text-4xl text-white text-center py-2">
                    {{ featured_package.title }}
                </h3>

                <p class="text-white text-center py-2">
                    {{ featured_package.speed }}
                    {{ featured_package.speed_type == 'kilobyte' ? 'KB' : (featured_package.speed_type == 'megabyte' ? 'MB'
                        : 'GB') }}

                    for {{ featured_package.duration }} {{ featured_package.duration_type }}
                </p>

                <div class="flex p-1">
                    <div class="flex-none w-28">
                        <h4 class="text-2xl text-white">
                            {{ featured_package.amount }} KES
                        </h4>
                    </div>
                    <div class="flex-auto text-right pr-4">
                        <a href="{{ url(route('isp_access_buypackage', ['id' => featured_package.id])) }}"
                            class="bg-yellow-300 hover:bg-yellow-200 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{
                                __('Buy') }}</a>
                    </div>
                </div>

            </div>


        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            id: null,
            featured_package: {
                'id': 1,
                'title': 'Sample',
                'speed': 1,
                'speed_type': 'megabyte',
                'duration': 1,
                'duration_type': "Month",
                'amount': 100,
            },
        }
    }
}
</script>

