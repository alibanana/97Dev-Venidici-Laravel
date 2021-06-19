<?php

namespace App\Helper;

use App\Models\Course;

class CourseHelper {

    // Function to delete Course by a course object.
    public static function deleteById($id) {
        try {
            $course = Course::findOrFail($id);
            
            unlink($course->thumbnail);
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

    // Function to set course's publish status to its opposite value.
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

    // Function to set course's isFeatured status to its opposite value.
    public static function setIsFeaturedStatusToOppositeById($id) {
        try {
            $course = Course::findOrFail($id);
            $course->isFeatured = !$course->isFeatured;
            $course->save();

            if ($course->courseType->type == "Course") {
                $message = 'Online Course (' . $course->title;
            } elseif ($course->courseType->type == "Woki") {
                $message = 'Woki Course (' . $course->title;
            }

            if ($course->isFeatured)
                $message = $message . ') is now featured.';
            else
                $message = $message . ') has been un-featured.';

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
    public static function updatePublishStatusById($id, $publish_status) {
        try {
            $course = Course::findOrFail($id);
            $course->publish_status = $publish_status;
            $course->save();

            if ($course->courseType->type == 'Course')
                $messageVariable = 'Online';
            elseif ($course->courseType->type == 'Woki')
                $messageVariable = 'Woki';

            if ($course->wasChanged()) {
                $message = $messageVariable . ' Course (' . $course->title . '), "Publish Status" has been updated';
            } else {
                $message = 'No changes was made to ' . $messageVariable . ' Course (' . $course->title . ')';
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

    // Function to update the course's total_duration.
    public static function updateTotalDuration($id) {
        try {
            $course = Course::findOrFail($id);

            $newTotalDuration = 0;
            foreach ($course->sections as $section) {
                foreach ($section->sectionContents as $content) {
                    $newTotalDuration += $content->duration;
                }
            }

            if ($newTotalDuration == 0) {
                $course->total_duration = null;
            } else {
                $totalDurationMinutes = floor($newTotalDuration / 60);
                $totalDurationSeconds = $newTotalDuration - ($totalDurationMinutes * 60);
                $newTotalDurationConverted = $totalDurationMinutes . ',' . $totalDurationSeconds;
                $course->total_duration = $newTotalDurationConverted;
            }
            
            $course->save();

            return [
                'status' => 'Success',
                'data' => $course,
                'message' => "Course's total duration has been updated."
            ];
        } catch (Exception $e) {
            return [
                'status' => 'Failed',
                'message' => "Caught exception: " . $e->getMessage()
            ];
        }
    } 

    // Function to attach teacher to a course.
    public static function attachTeacher($course, $teacher) {
        try {
            $course->teachers()->attach($teacher->id);
            $message = $teacher->name . ' has been added to the course.';
            return [
                'status' => 'Success',
                'message' => $message
            ];
        } catch (Exception $e) {
            return [
                'status' => 'Failed',
                'message' => "Caught exception: " . $e->getMessage()
            ];
        }
    }

    // Function to detach teacher from a course.
    public static function detachTeacher($course, $teacher) {
        try {
            $course->teachers()->detach($teacher->id);
            $message = $teacher->name . ' has been removed from the course.';
            return [
                'status' => 'Success',
                'message' => $message
            ];
        } catch (Exception $e) {
            return [
                'status' => 'Failed',
                'message' => "Caught exception: " . $e->getMessage()
            ];
        }
    }

    // Calculate course's average rating.
    public static function calculateAverageRating($id) {
        try {
            $course = Course::findOrFail($id);

            $totalReviewScore = 0;
            foreach ($course->reviews as $review) {
                $totalReviewScore += $review->review;
            }

            $course->average_rating = $totalReviewScore / count($course->reviews);
            $course->save();

            return [
                'status' => 'Success',
                'data' => $course,
                'message' => "Course's average rating has been updated."
            ];
        } catch (Exception $e) {
            return [
                'status' => 'Failed',
                'message' => "Caught exception: " . $e->getMessage()
            ];
        }
    }

}