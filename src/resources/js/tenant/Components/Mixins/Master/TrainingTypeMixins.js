import {TRAINING_TYPES} from '../../../Config/ApiUrl'

export default {
    data() {
        return {
            options: {
                name: this.$t('name'),
                url: TRAINING_TYPES,
                showHeader: true,
                tableShadow:false,
                tablePaddingClass:'pt-primary',
                columns: [
                    {
                        title: this.$t('name'),
                        type: 'text',
                        key: 'name',
                        isVisible: true,
                    },
                ],
                filters: [
                    {
                        title: this.$t('created'),
                        type: "range-picker",
                        key: "date",
                        option: ["today", "thisMonth", "last7Days", "thisYear"]
                    },
                ],
                paginationType: "pagination",
                responsive: true,
                rowLimit: 10,
                showAction: (this.$have('PERMISSION_UPDATE_TRAINING_TYPE') || this.$have('PERMISSION_DELETE_TRAINING_TYPE')),
                orderBy: 'desc',
                actionType: "default",
                actions: [
                    {
                        title: this.$t('edit'),
                        icon: 'edit',
                        type: 'modal',
                        component: 'app-training-type-modal',
                        modalId: 'training-type-modal',
                        url: TRAINING_TYPES,
                        name: 'edit',
                        modifier: () => this.$have('PERMISSION_UPDATE_TRAINING_TYPE')
                    },
                    {
                        title: this.$t('delete'),
                        name: 'delete',
                        icon: 'trash-2',
                        modalClass: 'warning',
                        url: TRAINING_TYPES,
                        modifier: () => this.$have('PERMISSION_DELETE_TRAINING_TYPE')
                    },
                ],
            },
            isTrainingTypeAddEditModalActive: false,
            isTrainingTypeDeleteModalActive: false,
        }
    },

    beforeMount() {
        if (this.$have('PERMISSION_UPDATE_TRAINING_TYPE') || this.$have('PERMISSION_DELETE_TRAINING_TYPE')) {
            this.options.columns.push({
                title: this.$t('actions'),
                type: 'action'
            })
        }
    },
}
