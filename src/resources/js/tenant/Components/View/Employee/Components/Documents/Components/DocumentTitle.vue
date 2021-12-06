<template>
    <div class="d-flex align-items-center mb-3 mb-lg-0">
        <!-- {{ identifier === 'ktp' ? $t('ktp') : $t('npwp')  }} -->

        {{ identifier === 'ktp' ? $t('ktp') : 
            ( identifier === 'npwp' ? $t('npwp') : 
            ( identifier === 'bpjs_ketenagakerjaan' ? $t('bpjs_ketenagakerjaan') : $t('bpjs_kesehatan' ) ) ) }}
    </div>
</template>

<script>
export default {
    name: "DocumentTitle",
    props: {
        identifier: {
            type: String,
            default: 'ktp'
        }
    }
}
</script>