<template>
    <div class="content-wrapper">
        <app-page-top-section :title="$t('daily_log')">
            <div class="d-flex d-inline">
                <app-default-button
                    btn-class="btn btn-success mr-2"
                    :title="$t('export')"
                    v-if="$can('export_attendance_daily_log')"
                    @click="exportConfirmationModal = true"
                />
                <app-attendance-top-buttons :tableId="tableId"/>
            </div>
        </app-page-top-section>
        <app-table
            :id="tableId"
            :options="options"
            @action="triggerActions"
            @getFilteredValues="setQueryObject"
        />

        <app-attendance-create-edit-modal
            v-if="isAttendanceModalActive"
            v-model="isAttendanceModalActive"
        />

        <app-attendance-edit-request-modal
            v-if="isEditModalActive"
            v-model="isEditModalActive"
            :selectedUrl="selectedUrl"
            :tableId="tableId"
        />

        <app-confirmation-modal
            v-if="confirmationModalActive"
            :message="modalSubtitle"
            :modal-class="modalClass"
            :icon="modalIcon"
            modal-id="app-confirmation-modal"
            @confirmed="updateStatus()"
            @cancelled="cancelled"
        />

        <app-attendance-log-modal
            v-if="isAttendanceLogModalActive"
            v-model="isAttendanceLogModalActive"
            :url="changeLogUrl"
            :tableId="tableId"
        />

        <app-confirmation-modal
            v-if="exportConfirmationModal"
            :title="$t('attendance_export_title')"
            :message="$t('attendance_export_message')"
            modal-id="app-confirmation-modal"
            modal-class="primary"
            icon="download"
            :first-button-name="$t('export')"
            :second-button-name="$t('cancel')"
            @confirmed="exportFilteredAttendance()"
            @cancelled="exportConfirmationModal = false"
            :self-close="false"
        />

    </div>
</template>

<script>
import AttendanceDailyLogMixin from "../../Mixins/AttendanceDailyLogMixin";
import AppAttendanceTopButtons from "./Component/AppAttendanceTopButtons";
import AttendanceRequestActionMixin from "../../Mixins/AttendanceRequestActionMixin";
import {urlGenerator} from "../../../../common/Helper/AxiosHelper";
import {formatDateForServer, localTimeZone} from "../../../../common/Helper/Support/DateTimeHelper";
import {objectToQueryString} from "../../../../common/Helper/Support/TextHelper";

export default {
    name: "DailyLog",
    mixins: [AttendanceDailyLogMixin, AttendanceRequestActionMixin],
    components: {AppAttendanceTopButtons},
    data() {
        return {
            tableId:'daily-log',
            isAttendanceModalActive: false,
            selectedUrl: '',
            exportConfirmationModal: false,
            queryObject: {}
        }
    },
    methods: {
        openAttendanceModal() {
            this.isAttendanceModalActive = true;
        },
        exportFilteredAttendance() {
            let query = _.isEmpty(this.queryObject) ? `date=${formatDateForServer(new Date())}` : objectToQueryString(this.queryObject);
            window.location = urlGenerator(`${this.apiUrl.EXPORT}/attendance/daily-log?${query}&timeZone=${localTimeZone}`);
            $("#app-confirmation-modal").modal('hide');
            $(".modal-backdrop").remove();
            this.exportConfirmationModal = false;
        },
        setQueryObject(obj){
            this.queryObject = obj;
        }
    }
}
</script>