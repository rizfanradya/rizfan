<?php
defined('MOODLE_INTERNAL') || die();

/**
 * Inject student ID and name into course and quiz attempt pages.
 *
 * @return string HTML to be added before the standard HTML head.
 */
function local_studentid_display_before_standard_html_head()
{
    global $USER, $PAGE;

    if (!isloggedin() || isguestuser() || !has_capability('local/studentid_display:viewstudentinfo', $PAGE->context)) {
        return '';
    }

    if (strpos($PAGE->pagetype, 'course-view-') === 0 || $PAGE->pagetype === 'mod-quiz-attempt') {
        $idnumber = !empty($USER->idnumber) ? s($USER->idnumber) : get_string('noidnumber', 'local_studentid_display');
        $name = fullname($USER);
        $output = '<div class="student-info">';
        $output .= '<p>Student: ' . $name . '<br>ID: ' . $idnumber . '</p>';
        $output .= '</div>';
        return $output;
    }

    return '';
}
