import {EDUCATION_LEVELS} from '../../../Config/ApiUrl'

export default {
    data() {
        return {
            options: {
                name: this.$t('name'),
                url: EDUCATION_LEVELS,
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
                showAction: (this.$have('PERMISSION_UPDATE_EDUCATION_LEVEL') || this.$have('PERMISSION_DELETE_EDUCATION_LEVEL')),
                orderBy: 'desc',
                actionType: "default",
                actions: [
                    {
                        title: this.$t('edit'),
                        icon: 'edit',
                        type: 'modal',
                        component: 'app-education-level-modal',
                        modalId: 'education-level-modal',
                        url: EDUCATION_LEVELS,
                        name: 'edit',
                        modifier: () => this.$have('PERMISSION_UPDATE_EDUCATION_LEVEL')
                    },
                    {
                        title: this.$t('delete'),
                        name: 'delete',
                        icon: 'trash-2',
                        modalClass: 'warning',
                        url: EDUCATION_LEVELS,
                        modifier: () => this.$have('PERMISSION_DELETE_EDUCATION_LEVEL')
                    },
                ],
            },
            isEducationLevelAddEditModalActive: false,
            isEducationLevelDeleteModalActive: false,
        }
    },

    beforeMount() {
        if (this.$have('PERMISSION_UPDATE_EDUCATION_LEVEL') || this.$have('PERMISSION_DELETE_EDUCATION_LEVEL')) {
            this.options.columns.push({
                title: this.$t('actions'),
                type: 'action'
            })
        }
    },
}
