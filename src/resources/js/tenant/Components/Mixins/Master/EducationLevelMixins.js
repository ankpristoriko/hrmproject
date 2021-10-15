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
                    {
                        title: this.$t('actions'),
                        type: 'action',
                        isVisible: true
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
                showAction: true,
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
                        modifier: row => this.$can('update_education_levels')
                    },
                    {
                        title: this.$t('delete'),
                        name: 'delete',
                        icon: 'trash-2',
                        modalClass: 'warning',
                        url: EDUCATION_LEVELS,
                        modifier: row => this.$can('delete_education_levels')
                    },
                ],
            }
        }
    }
}
