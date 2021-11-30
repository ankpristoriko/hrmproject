import Vue from 'vue'
import UrlMixin from "./Config/UrlMixin";
import TenantMixin from './Config/TenantMixin'
Vue.mixin(UrlMixin);
Vue.mixin(TenantMixin);

//Support
Vue.component('app-form-group-selectable', require('./Components/Helper/AppFromGroupSelectable').default)
Vue.component('app-note-editor', require('./Components/Helper/AppNoteEditor').default)
Vue.component('app-month-calendar', require('./Components/Helper/MonthCalendar').default);
Vue.component('app-period-calendar', require('./Components/Helper/PeriodCalendar').default)

// Dashboard
Vue.component('app-dashboard', require('./Components/View/Dashboard/Dashboard').default)
Vue.component('app-admin-dashboard', require('./Components/View/Dashboard/components/AdminDashboard').default)
Vue.component('app-working-today', require('./Components/View/Dashboard/components/OnWorkingToday').default)
Vue.component('app-employee-statistics', require('./Components/View/Dashboard/components/EmployeeStatistics').default)
Vue.component('app-employee-dashboard', require('./Components/View/Dashboard/components/EmployeeDashboard').default)

//Auth
Vue.component('app-password-reset', require('../common/Components/Auth/Password/RequestResetPassword').default)
Vue.component('app-reset-password', require('../common/Components/Auth/Password/ResetPassword').default)

//Department
Vue.component('app-departments', require('./Components/View/Employee/Department/Departments').default)
Vue.component('app-department-modal', require('./Components/View/Employee/Department/DepartmentCreateEditModal').default)
Vue.component('app-employee-move-modal', require('./Components/View/Employee/Department/EmployeeMoveModal').default)
Vue.component('app-organization-structure', require('./Components/View/Employee/Department/OrganizationStructure').default)

//Settings
Vue.component('app-tenant-settings-layout', require('./Components/View/Setting/TenantSettingLayout').default)
Vue.component('app-tenant-general-settings', require('./Components/View/Setting/Component/TenantGeneralSetting').default)
Vue.component('app-tenant-notification-settings', require('./Components/View/Setting/Component/TenantNotificationSetting').default)
Vue.component('app-attendance-settings', require('./Components/View/Setting/AttendanceSettingLayout').default)
Vue.component('app-attendance-preference-settings', require('./Components/View/Setting/Component/AttendancePreferenceSettings').default)
Vue.component('app-attendance-definition-settings', require('./Components/View/Setting/Component/AttendanceDefinitionSettings').default)

Vue.component('app-tenant-manager', require('./Components/View/TenantManager/TenantManager').default)
Vue.component('app-punch-in', require('./Components/View/Attendance/Component/AppPunchInOut').default)
Vue.component('app-leave-settings-layout', require('./Components/View/Setting/LeaveSettingLayout').default)
Vue.component('app-payroll-settings-layout', require('./Components/View/Setting/PayrollSettingLayout').default)

//Employment Statuses
Vue.component('app-employment-statuses', require('./Components/View/Employee/EmploymentStatus/EmploymentStatuses').default)
Vue.component('app-employment-status-create-edit-modal', require('./Components/View/Employee/EmploymentStatus/EmploymentStatusCreateEditModal').default)


//Employee designation
Vue.component('app-designations', require('./Components/View/Employee/Designation/Designations').default);
Vue.component('app-designation-modal', require('./Components/View/Employee/Designation/DesignationCreateEditModal').default);

//Working Shift
Vue.component('app-working-shift', require('./Components/View/Adminstration/WorkingShift/WorkingShift').default);
Vue.component('app-working-shift-modal', require('./Components/View/Adminstration/WorkingShift/WorkingShiftCreateEditModal').default);
Vue.component('app-employee-to-work-shift', require('./Components/View/Adminstration/WorkingShift/AddEmployeeToWorkShift').default);

//Holiday
Vue.component('app-holiday', require('./Components/View/Adminstration/Holiday/Holiday').default);
Vue.component('app-holiday-modal', require('./Components/View/Adminstration/Holiday/HolidayCreateEditModal').default);
Vue.component('app-holiday-calendar', require('./Components/View/Adminstration/Holiday/HolidayCalendar').default);

//Employee
Vue.component('app-employee-card-view', require('./Components/View/Employee/EmployeeCardView').default);
Vue.component('app-employee-preview-card', require('./Components/View/Employee/Components/EmployeePreviewCard').default);
Vue.component('app-employee-list', require('./Components/View/Employee/Employees').default);
Vue.component('app-employee-invite', require('./Components/View/Employee/EmployeeInviteEditModal').default);
Vue.component('app-employee-media-object', require('./Components/View/Employee/Components/EmployeeMediaObject').default);
Vue.component('app-employee-status', require('./Components/View/Employee/Components/EmployeeStatus').default);
Vue.component('app-employee-termination-reason-modal', require('./Components/View/Employee/EmployeeTerminationReasonModal').default);

//Employee Details
Vue.component('app-employee-details', require('./Components/View/Employee/Employee').default);
Vue.component('app-employee-personal-details',require('./Components/View/Employee/Components/PersonalDetails/PersonalDetails').default);
Vue.component('app-employee-password-change',require('./Components/View/Employee/Components/ChangePassword/ChangePassword').default);
Vue.component('app-employee-address-details',require('./Components/View/Employee/Components/AddressDetails/AddressDetails').default);
Vue.component('app-employee-emergency-contact',require('./Components/View/Employee/Components/EmergencyContact/EmergencyContacts').default);
Vue.component('app-employee-social-link',require('./Components/View/Employee/Components/SocialLinks/SocialLinks').default);
Vue.component('app-employee-job-history',require('./Components/View/Employee/Components/JobHistory/JobHistory').default);
Vue.component('app-employee-salary-reviews',require('./Components/View/Employee/Components/SalaryReviews/SalaryReviews').default);
Vue.component('app-employee-attendance',require('./Components/View/Employee/Components/Attendance/Attendance').default);
Vue.component('app-employee-leave',require('./Components/View/Employee/Components/Leave/Leave').default);
Vue.component('app-employee-address-details-model',require('./Components/View/Employee/Components/AddressDetails/AddressDetailsEditModal').default);
Vue.component('app-employment-status-modal',require('./Components/View/Employee/EmploymentStatusModal').default);
Vue.component('app-employee-emergency-contact-model',require('./Components/View/Employee/Components/EmergencyContact/EmergencyContactEditModal').default);
Vue.component('app-employee-allowance',require('./Components/View/Employee/Components/Allowance/Allowance').default);
Vue.component('app-allowance-update-modal',require('./Components/View/Employee/Components/Allowance/AllowanceUpdateModal').default);
Vue.component('app-employee-payslip',require('./Components/View/Employee/Components/Payrun/EmployeePayslip').default);

//Attendance
Vue.component('app-attendance-create-edit-modal', require('./Components/View/Attendance/Component/AttendanceCreateEditModal').default);
Vue.component('app-attendance-details', require('./Components/View/Attendance/AttendanceDetails').default);
Vue.component('app-attendance-summery', require('./Components/View/Attendance/AttendanceSummaries').default);
Vue.component('app-attendance-request', require('./Components/View/Attendance/AttendanceRequests').default);
Vue.component('app-attendance-employee-media-object', require('./Components/View/Attendance/Component/AttendanceRequest/MediaObject').default);
Vue.component('app-attendance-expandable-column', require('./Components/View/Attendance/Component/AttendanceRequest/ExpandableColumn').default);
Vue.component('app-attendance-request-type', require('./Components/View/Attendance/Component/AttendanceRequest/RequestType').default)
Vue.component('app-daily-log', require('./Components/View/Attendance/AttendanceDailyLogs').default);
Vue.component('app-punch-in-date-time', require('./Components/View/Attendance/Component/PunchInDateTime').default);
Vue.component('app-punch-out-date-time', require('./Components/View/Attendance/Component/PunchOutDateTime').default);
Vue.component('app-attendance-type', require('./Components/View/Attendance/Component/AttendanceRequest/AttendanceType').default);
Vue.component('app-attendance-edit-request-modal', require('./Components/View/Attendance/Component/AttendanceEditRequestModal').default);
Vue.component('app-attendance-log-modal', require('./Components/View/Attendance/Component/AttendanceLogModal').default)
Vue.component('app-attendance-summary-table', require('./Components/View/Attendance/Component/AttendanceSummaryTable').default)

//Leave
Vue.component('app-leave-status', require('./Components/View/Leave/LeaveStatus').default);
Vue.component('app-leave-create-edit-modal', require('./Components/View/Leave/Components/LeaveCreateEditModal').default);
Vue.component('app-leave-response-log-modal', require('./Components/View/Leave/Components/ResponseLogModal').default);
Vue.component('app-leave-types', require('./Components/View/Leave/LeaveTypes').default);
Vue.component('app-leave-type-create-edit', require('./Components/View/Leave/Components/LeaveTypeCreateEditModal').default);
Vue.component('app-leave-periods', require('./Components/View/Leave/LeavePeriods').default);
Vue.component('app-leave-period-create-edit', require('./Components/View/Leave/Components/LeavePeriodCreateEditModal').default);
Vue.component('app-leave-requests', require('./Components/View/Leave/LeaveRequests').default);
Vue.component('app-leave-calendar', require('./Components/View/Leave/LeaveCalendar').default);
Vue.component('app-leave-summary', require('./Components/View/Leave/LeaveSummaries').default);
Vue.component('app-leave-date-time',require('./Components/View/Leave/Components/LeaveDateAndTime').default);
Vue.component('app-attachments-column',require('./Components/View/Leave/Components/AttachmentsColumn').default);
Vue.component('app-activity-column',require('./Components/View/Leave/Components/LeaveActivity').default);
Vue.component('app-leave-allowance-policy', require('./Components/View/Setting/Component/LeaveAllowancePolicy').default);
Vue.component('app-leave-approval-setting', require('./Components/View/Setting/Component/LeaveApprovalSetting').default);

//Leave type
Vue.component('app-leave-types-setting', require('./Components/View/Leave/LeaveTypes').default)
Vue.component('app-leave-allow-earning-button', require('./Components/View/Leave/Components/AllowEarningToggleButton').default)

//Leave period
Vue.component('app-leave-periods', require('./Components/View/Leave/LeavePeriods').default)
Vue.component('app-leave-period-create-edit', require('./Components/View/Leave/Components/LeavePeriodCreateEditModal').default)

//ImportDatabase
Vue.component('app-import-database', require('./Components/View/Setting/Import/ImportDatabase').default);
Vue.component('app-import-loading-modal', require('./Components/View/Setting/Import/ImportLoadingModal').default);

//update
Vue.component('app-update', require('./Components/View/Setting/Update/Update').default)
Vue.component('app-update-confirmation-modal', require('./Components/View/Setting/Update/UpdateConfirmationModal').default)

//Payroll
Vue.component('app-default-payrun-setting', require('./Components/View/Setting/Component/Payroll/DefaultPayrunSetting').default)
Vue.component('app-payrun-audience-setting', require('./Components/View/Setting/Component/Payroll/PayrunAudienceSetting').default)
Vue.component('app-badge-value-setting', require('./Components/View/Setting/Component/Payroll/BadgeValueSetting').default)
Vue.component('app-beneficiary-badges', require('./Components/View/Payroll/BeneficiaryBadge').default)
Vue.component('app-beneficiary-badges-create-edit-modal', require('./Components/View/Payroll/BeneficiaryBadgeCreateEditModal').default)
Vue.component('app-beneficiary-status-toggle-button', require('./Components/View/Payroll/Components/BeneficiaryStatusToggleButton').default)
Vue.component('app-payrun', require('./Components/View/Payroll/Payrun').default)
Vue.component('app-manual-payrun', require('./Components/View/Payroll/ManualPayrun').default)
Vue.component('app-audience-wizard', require('./Components/View/Payroll/Components/AudienceWizard').default)
Vue.component('app-payrun-period-wizard', require('./Components/View/Payroll/Components/PayrunPeriodWizard').default)
Vue.component('app-beneficiary-badge-wizard', require('./Components/View/Payroll/Components/BeneficiaryBadgeWizard').default)
Vue.component('app-manual-payrun-note-wizard', require('./Components/View/Payroll/Components/ManualPayrunNoteWizard').default)
Vue.component('app-payslip-setting', require('./Components/View/Setting/Component/Payroll/PayslipSetting').default)

//Payrun
Vue.component('app-employee-payrun-and-badge', require('./Components/View/Employee/Components/Payrun/PayrunAndBadge').default)
Vue.component('app-employee-payrun-period-modal', require('./Components/View/Employee/Components/Payrun/Components/EmployeePayrunPeriodModal').default)
Vue.component('app-employee-beneficiary-modal', require('./Components/View/Employee/Components/Payrun/Components/EmployeeBeneficiaryModal').default)

//Payslip
Vue.component('app-payslip', require('./Components/View/Payroll/Payslip').default)
Vue.component('app-payslip-view-modal', require('./Components/View/Payroll/Components/PayslipViewModal').default)
Vue.component('app-payslip-edit-modal', require('./Components/View/Payroll/Components/PayslipEditModal').default)
Vue.component('app-payslip-conflict-modal', require('./Components/View/Payroll/Components/PayslipConflictModal').default)
Vue.component('app-payrun-conflict-modal', require('./Components/View/Payroll/Components/PayrunConflictModal').default)

//Payroll Summery
Vue.component('app-payroll-summery', require('./Components/View/Payroll/PayrollSummery').default)


//Import
Vue.component('app-import-employees', require('./Components/View/Setting/Import/ImportEmployees').default);
Vue.component('app-import-layout', require('./Components/View/Setting/ImportLayout').default);


// Promotion
Vue.component('promotion-view-table', require('./Components/View/CoreHR/Promotion/Promotion').default);
Vue.component('promotion-view', require('./Components/View/CoreHR/Promotion/PromotionView').default);
Vue.component('promotion-card', require('./Components/View/CoreHR/Promotion/PromotionCard').default);
Vue.component('promotion-modal', require('./Components/View/CoreHR/Promotion/PromotionModal').default);

// Master Setting Layout
Vue.component('app-master-settings-layout', require('./Components/View/Setting/MasterSettingLayout').default);

// Document Type
Vue.component('app-document-types', require('./Components/View/Master/DocumentType/DocumentTypes').default);
Vue.component('app-document-type-create-edit', require('./Components/View/Master/Components/DocumentTypeCreateEditModal').default);

// Warning Type
Vue.component('app-warning-types', require('./Components/View/Master/WarningType/WarningTypes').default);
Vue.component('app-warning-type-create-edit', require('./Components/View/Master/Components/WarningTypeCreateEditModal').default);

// Award Type
Vue.component('app-award-types', require('./Components/View/Master/AwardType/AwardTypes').default);
Vue.component('app-award-type-create-edit', require('./Components/View/Master/Components/AwardTypeCreateEditModal').default);

// Termination Type
Vue.component('app-termination-types', require('./Components/View/Master/TerminationType/TerminationTypes').default);
Vue.component('app-termination-type-create-edit', require('./Components/View/Master/Components/TerminationTypeCreateEditModal').default);

// Expense Type
Vue.component('app-expense-types', require('./Components/View/Master/ExpenseType/ExpenseTypes').default);
Vue.component('app-expense-type-create-edit', require('./Components/View/Master/Components/ExpenseTypeCreateEditModal').default);

// Expense Type
Vue.component('app-training-types', require('./Components/View/Master/TrainingType/TrainingTypes').default);
Vue.component('app-training-type-create-edit', require('./Components/View/Master/Components/TrainingTypeCreateEditModal').default);

// Education Level
Vue.component('app-education-levels', require('./Components/View/Master/EducationLevel/EducationLevels').default);
Vue.component('app-education-level-create-edit', require('./Components/View/Master/Components/EducationLevelCreateEditModal').default);

// Recruitment
Vue.component('app-job-settings-layout', require('./Components/View/Recruitment/JobSettingLayout').default);
Vue.component('app-recruitment-dashboard', require('./Components/View/Recruitment/Dashboard/Index').default);

// Job Type
Vue.component('app-job-types', require('./Components/View/Recruitment/JobType/JobTypes').default);
Vue.component('app-job-type-create-edit', require('./Components/View/Recruitment/Components/JobTypeCreateEditModal').default);

// Event Type
Vue.component('app-event-types', require('./Components/View/Recruitment/EventType/EventTypes').default);
Vue.component('app-event-type-create-edit', require('./Components/View/Recruitment/Components/EventTypeCreateEditModal').default);

// Stage
Vue.component('app-stages', require('./Components/View/Recruitment/Stage/Stages').default);
Vue.component('app-stage-create-edit', require('./Components/View/Recruitment/Components/StageCreateEditModal').default);

Vue.component('application-form-setting', require('./Components/View/Recruitment/ApplyForm/ApplyForm').default);
Vue.component('personal-info-modal', require('./Components/View/Recruitment/Components/PersonalInfoModal').default);
Vue.component('question-add-edit-modal', require('./Components/View/Recruitment/Components/QuestionAddEditModal').default);
Vue.component('assignment-add-edit-modal', require('./Components/View/Recruitment/Components/AssignmentAddEditModal').default);

Vue.component('modal-app-form', require('./Components/Helper/Modal/Modal').default);
Vue.component('app-custom-field-modal', require('./Components/Helper/Modal/CustomFieldModal').default);
Vue.component('apply-form-settings', require('./Components/View/Recruitment/Components/ApplyForm').default);

// Candidate App Module
Vue.component('candidates', require('./Components/View/Recruitment/Candidates/Index').default);
Vue.component('candidate-jobs-expandable-view', require('./Components/View/Recruitment/Candidates/Helpers/CandidateJobsExpandableView').default);
Vue.component('candidate-table-star-review', require('./Components/View/Recruitment/Candidates/Helpers/StarReview').default);
Vue.component('candidate-details-modal', require('./Components/View/Recruitment/Candidates/CandidateDetailsModal').default);
Vue.component('candidate-assign-job-modal', require('./Components/View/Recruitment/Candidates/CandidateActionsModal/AssignJobModal').default);
Vue.component('candidate-add-edit-modal', require('./Components/View/Recruitment/Candidates/CandidateActionsModal/CandidateAddEditModal').default);
Vue.component('candidate-disqualify-modal', require('./Components/View/Recruitment/Candidates/CandidateActionsModal/DisqualifyModal').default);
Vue.component('candidate-mailing-modal', require('./Components/View/Recruitment/Candidates/CandidateActionsModal/MailingModal').default);
Vue.component('candidate-event-modal', require('./Components/View/Recruitment/Candidates/CandidateActionsModal/EventAddEditModal').default);
Vue.component('career-page', require('./Components/View/Recruitment/CareerPage/Index').default);
Vue.component('candidate-status', require('./Components/View/Recruitment/Candidates/Helpers/CandidateStatus').default);
