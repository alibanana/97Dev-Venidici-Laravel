<?php

namespace App\Helper;

use App\Models\Course;

class CourseHelper {

    // Function to delete Course by a course object.
    public static function deleteById($id) {
        try {
            $course = Course::findOrFail($id);
            
            // unlink($course->thumbnail);
            $course->delete();
            
            if ($course->courseType->type == "Course") {
                $message = 'Online Course (' . $course->title . ') has been deleted.';
            } elseif ($course->courseType->type == "Woki") {
                $message = 'Woki Course (' . $course->title . ') has been deleted.';
            }

            return [
                'status' => 'Success',
                'data' => $course,
                'message' => $message
            ];
        } catch (Exception $e) {
            return [
                'status' => 'Failed',
                'message' => "Caught exception: " . $e->getMessage()
            ];
        }
    }

    // Function to update course's publish status.
    public static function setPublishStatusToOppositeById($id) {
        try {
            $course = Course::findOrFail($id);

            if ($course->publish_status == 'Draft') {
                $course->publish_status = 'Published';
            } else if ($course->publish_status == 'Published') {
                $course->publish_status = 'Draft';
            }
            
            $course->save();

            if ($course->courseType->type == "Course") {
                $message = 'Online Course (' . $course->title . ') publish_status updated to ' . $course->publish_status;
            } elseif ($course->courseType->type == "Woki") {
                $message = 'Woki Course (' . $course->title . ') publish_status updated to ' . $course->publish_status;
            }

            return [
                'status' => 'Success',
                'data' => $course,
                'message' => $message
            ];
        } catch (Exception $e) {
            return [
                'status' => 'Failed',
                'message' => "Caught exception: " . $e->getMessage()
            ];
        }
    }

}