import {COURSE_CATEGORIES} from '../../../Config/ApiUrl'

export default {
    data() {
        return {
            options: {
                name: this.$t('name'),
                url: COURSE_CATEGORIES,
                showHeader: true,
                tableShadow:false,
                tablePaddingClass:'pt-primary',
                columns: [
                    {
                        title: this.$t('code'),
                        type: 'text',
                        key: 'code',
                        isVisible: true,
                    },
                    {
                        title: this.$t('name'),
                        type: 'text',
                        key: 'name',
                        isVisible: true,
                    },
                    {
                        title: this.$t('description'),
                        type: 'text',
                        key: 'description',
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
                showAction: (this.$have('PERMISSION_UPDATE_COURSE_CATEGORY') || this.$have('PERMISSION_DELETE_COURSE_CATEGORY')),
                orderBy: 'desc',
                actionType: "default",
                actions: [
                    {
                        title: this.$t('edit'),
                        icon: 'edit',
                        type: 'modal',
                        component: 'app-course-category-modal',
                        modalId: 'course-category-modal',
                        url: COURSE_CATEGORIES,
                        name: 'edit',
                        modifier: () => this.$have('PERMISSION_UPDATE_COURSE_CATEGORY')
                    },
                    {
                        title: this.$t('delete'),
                        name: 'delete',
                        icon: 'trash-2',
                        modalClass: 'warning',
                        url: COURSE_CATEGORIES,
                        modifier: () => this.$have('PERMISSION_DELETE_COURSE_CATEGORY')
                    },
                ],
            },
            isCourseCategoryAddEditModalActive: false,
            isCourseCategoryeDeleteModalActive: false,
        }
    },

    beforeMount() {
        if (this.$have('PERMISSION_UPDATE_COURSE_CATEGORY') || this.$have('PERMISSION_DELETE_COURSE_CATEGORY')) {
            this.options.columns.push({
                title: this.$t('actions'),
                type: 'action'
            })
        }
    },
}
