import {TENANT_BASE_URL} from '../../common/Config/UrlHelper';

export const TENANT_GENERAL_SETTING_URL = `${TENANT_BASE_URL}general/settings`;
export const TENANTS = `app/user/tenants`;
export const EMPLOYMENT_STATUSES = `${TENANT_BASE_URL}app/employment-statuses`;
export const DESIGNATION = `${TENANT_BASE_URL}app/designations`;
export const TEST_MAIL = `${TENANT_BASE_URL}app/test-mail/send`;

// Department
export const DEPARTMENTS = `${TENANT_BASE_URL}app/departments`;
export {TENANT_SELECTABLE_USER as TENANT_SELECTABLE_USER}  from "../../common/Config/apiUrl";
export {TENANT_SELECTABLE_ROLES as TENANT_SELECTABLE_ROLES}  from "../../common/Config/apiUrl";
export const SELECTABLE_DEPARTMENT = `${TENANT_BASE_URL}selectable/departments`;
export const SELECTABLE_ROLE = `${TENANT_BASE_URL}selectable/roles`;
export const UPDATE_USER_TENANT_LAST_LOGIN = 'app/user/update-tenant';
export const TENANT_REDIRECTION_URL = 'admin/tenant-dashboard-redirect';
export const ORGANIZATION_STRUCTURE = `${TENANT_BASE_URL}/app/organization-structure`;
export const TENANTS_FRONT_END = 'app/tenants/lists';
export const EMPLOYEES_LIST = `${TENANT_BASE_URL}app/employee-list`;
export const SELECTABLE_DESIGNATION = `${TENANT_BASE_URL}selectable/designations`;
export const SELECTABLE_EMPLOYMENT_STATUS = `${TENANT_BASE_URL}selectable/employment-statuses`;
export const SELECTABLE_WORKING_SHIFT = `${TENANT_BASE_URL}selectable/working-shifts`;
export const EMPLOYEES = `${TENANT_BASE_URL}app/employees`;
export const EMPLOYEES_PROFILE = `${TENANT_BASE_URL}employees`;
export const EMPLOYEE_INVITE = `${TENANT_BASE_URL}app/employees/invite`;
export const AUTO_EMPLOYEE_ID = `${TENANT_BASE_URL}/employees/profile/employee-id`;
export const WORKING_SHIFTS = `${TENANT_BASE_URL}app/working-shifts`;
export const ATTENDANCES = `${TENANT_BASE_URL}app/attendances`
export const EMPLOYEES_FRONTEND = `${TENANT_BASE_URL}employee/lists`;
export const DEPARTMENT_FRONTEND = `${TENANT_BASE_URL}administration/departments`;

// Holiday
export const HOLIDAYS = `${TENANT_BASE_URL}app/holidays`;

// Attendance
export const CHECK_PUNCH_IN = `${TENANT_BASE_URL}employees/check-punch-in`;
export const PUNCH_IN_TIME = `${TENANT_BASE_URL}employees/punch-in-time`;
export const ATTENDANCE_SETTINGS = `${TENANT_BASE_URL}app/settings/attendances`;
export const ATTENDANCE_DAILY_LOG = `${TENANT_BASE_URL}app/attendances/daily-log`;
export const ATTENDANCE_REQUESTS = `${TENANT_BASE_URL}app/attendances/request`;
export const ATTENDANCE_NOTES = `${TENANT_BASE_URL}app/attendances/comments`;
export const ATTENDANCE_SETTINGS_FRONT_END = `${TENANT_BASE_URL}settings/attendance`;

export const SELECTABLE = `${TENANT_BASE_URL}/selectable`;
export const APP_SELECTABLE = `${TENANT_BASE_URL}/app/selectable`;

// Leave
export const LEAVE_TYPES = `${TENANT_BASE_URL}app/leave-types`;
export const LEAVE_REQUESTS = `${TENANT_BASE_URL}app/leaves/request`;
export const SELECTABLE_LEAVE_TYPES = `${TENANT_BASE_URL}selectable/leave-types`;
export const LEAVE_PERIODS = `${TENANT_BASE_URL}app/leave-periods`;
export const LEAVE_SETTINGS_FRONT_END = `${TENANT_BASE_URL}settings/leave-settings`;
export const LEAVES = `${TENANT_BASE_URL}app/leaves`;
export const LEAVE_NOTES = `${TENANT_BASE_URL}app/leaves/request/comments`;
export const SELECTABLE_LEAVE_PERIODS = `${TENANT_BASE_URL}selectable/leave-periods`;
export const LEAVE_SETTINGS = `${TENANT_BASE_URL}app/settings/leaves`;
export const LEAVE_ASSIGN = `${TENANT_BASE_URL}app/leaves/assign`;
export const SELECTABLE_WORK_SHIFT_USERS = `${TENANT_BASE_URL}selectable/work-shift/users`;
export const SELECTABLE_WORK_SHIFT_DEPARTMENTS = `${TENANT_BASE_URL}selectable/work-shift/departments`;
export const SELECTABLE_HOLIDAY_DEPARTMENTS = `${TENANT_BASE_URL}selectable/holiday/departments`;
export const SELECTABLE_PAYRUN_DEPARTMENTS = `${TENANT_BASE_URL}selectable/payrun/departments`;
export const TENANT_SELECTABLE_LEAVE_USERS = `${TENANT_BASE_URL}selectable/leave-settings/users`;
export const TENANT_SELECTABLE_ATTENDANCE_USERS = `${TENANT_BASE_URL}selectable/attendance-settings/users`;
export const TENANT_SELECTABLE_DEPARTMENT_DEPARTMENTS = `${TENANT_BASE_URL}selectable/department/departments`;
export const TENANT_SELECTABLE_DEPARTMENT_USERS = `${TENANT_BASE_URL}selectable/department/users`;
export const TENANT_SELECTABLE_PAYRUN_USER = `${TENANT_BASE_URL}selectable/payrun/users`;

//dashboard
export const APP_DASHBOARD = `${TENANT_BASE_URL}app/dashboard`;

//employee
export const ALL_EMPLOYEE_URL_FRONT_END = `${TENANT_BASE_URL}employee/lists`;
export const SALARY_RANGE = `${TENANT_BASE_URL}app/salary-range`;

//Update
export const APP_UPDATE = `${TENANT_BASE_URL}app/updates`;

//Payroll
export const PAYROLL_SETTINGS = `${TENANT_BASE_URL}app/settings/payrun`;
export const PAYROLL_SETTINGS_FRONTEND = `${TENANT_BASE_URL}settings/payroll-settings`;
export const BENEFICIARY_BADGE = `${TENANT_BASE_URL}app/beneficiaries`;
export const SELECTABLE_BENEFICIARY_BADGE = `${TENANT_BASE_URL}selectable/beneficiaries`;
export const PAYRUN_FRONTEND = `${TENANT_BASE_URL}payroll/payrun`;
export const BENEFICIARY_BADGE_FRONTEND = `${TENANT_BASE_URL}payroll/beneficiary-badges`;
export const PAYSLIP_FRONTEND = `${TENANT_BASE_URL}payroll/payslip`;
export const PAYSLIP = `${TENANT_BASE_URL}app/payslip`;
export const DEFAULT_PAYRUN = `${TENANT_BASE_URL}app/payrun/default`;
export const EMPLOYEES_FOLLOWED_BY_EMPLOYEE_PAYRUN = `${TENANT_BASE_URL}app/payrun/default/employees`;
export const MANUAL_PAYRUN = `${TENANT_BASE_URL}/app/payrun/manual`;
export const PAYRUNS = `${TENANT_BASE_URL}/app/payruns`;
export const PAYRUN = `${TENANT_BASE_URL}/app/payrun`;
export const PAYROLL = `${TENANT_BASE_URL}/app/payroll`;

//import
export const IMPORT = `${TENANT_BASE_URL}/app/import`;

// Promotion
export const PROMOTION_DATA = `${TENANT_BASE_URL}core_hr/promotions`;
export const PROMOTION_SEARCH_SELECT = `${TENANT_BASE_URL}core_hr/promotion/employee`;

// Document Type
export const DOCUMENT_TYPES = `${TENANT_BASE_URL}app/document-types`;
export const WARNING_TYPES = `${TENANT_BASE_URL}app/warning-types`;
export const AWARD_TYPES = `${TENANT_BASE_URL}app/award-types`;
export const TERMINATION_TYPES = `${TENANT_BASE_URL}app/termination-types`;
export const EXPENSE_TYPES = `${TENANT_BASE_URL}app/expense-types`;
export const EDUCATION_LEVELS = `${TENANT_BASE_URL}app/education-levels`;
export const TRAINING_TYPES = `${TENANT_BASE_URL}app/training-types`;
export const RELATIONSHIPS = `${TENANT_BASE_URL}app/relationships`;

// Recruitment
export const JOB_TYPES = `${TENANT_BASE_URL}app/job-types`;
export const EVENT_TYPES = `${TENANT_BASE_URL}app/event-types`;
export const STAGES = `${TENANT_BASE_URL}app/stages`;
export const GLOBAL_APPLICATION_FORM = `${TENANT_BASE_URL}app/global/application-form`;
export const RECRUITMENT_DASHBOARD = `${TENANT_BASE_URL}app/recruitment-dashboard`;

// Candidate or Applicant - Global
export const CANDIDATE = `${TENANT_BASE_URL}app/applicant`;
export const VERIFY_EMAIL = `${TENANT_BASE_URL}app/applicant/check-email`;

export const CAREER_PAGE = `${TENANT_BASE_URL}app/career-page`;

export const EVENT = `${TENANT_BASE_URL}app/event`;

// Job Applicant - Applicant after applied job
export const JOB_APPLICANT = `${TENANT_BASE_URL}app/job-applicant`;

// Public Url
export const PUBLIC_JOB_POST = `${TENANT_BASE_URL}public/job-post`;
export const PUBLIC_VERIFY_EMAIL = `${TENANT_BASE_URL}public/candidate/check-email`;
export const PUBLIC_CAREER_PAGE = `${TENANT_BASE_URL}public/career`;