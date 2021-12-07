<template>
    <div class="d-flex align-items-center mb-3 mb-lg-0">
        <div>
            <div class="icon-box mr-2">
                <app-icon
                    name="file-text"
                    class="primary-text-color"
                    width="16"
                    height="16"
                />
            </div>
        </div>
        
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
        },
    }
}
</script>