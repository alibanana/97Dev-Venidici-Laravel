<?php

namespace App\Helper;

use Exception;

use App\Models\Course;
use App\Models\User;

class CourseHelper {

    // Function to archive Course by a course id.
    public static function makeIsDeletedTrueById($id) {
        try {
            $course = Course::findOrFail($id);

            // Check if course has been bought.
            $courseHasBeenBought = !$course->users->isEmpty();

            // Check if a user has checkout with the given course.
            $courseIsInPendingInvoice = false;
            foreach ($course->orders as $order) {
                $invoice = $order->invoice;
                if ($invoice->status == 'pending') {
                    $courseIsInPendingInvoice = true;
                    break;
                }
            }

            if (!$courseHasBeenBought && !$courseIsInPendingInvoice) {
                // Delete cart data that has course in it.
                if (!$course->carts->isEmpty()) {
                    $course->carts()->delete();
                }

                $course->isDeleted = true;
                $course->save();

                if ($course->courseType->type == "Course") {
                    $message = 'Online Course (' . $course->title . ') has been archived.';
                } elseif ($course->courseType->type == "Woki") {
                    $message = 'Woki Course (' . $course->title . ') has been archived.';
                } elseif ($course->courseType->type == "Bootcamp") {
                    $message = 'Bootcamp Course (' . $course->title . ') has been archived.';
                }
            } elseif ($courseHasBeenBought) {
                $message = 'Cannot archive courses that have been bought!';
            } elseif ($courseIsInPendingInvoice) {
                $message = 'Cannot archive courses that is available in a pending invoice!';
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

    // Function to un-archive Course by a course id.
    public static function makeIsDeletedFalseById($id) {
        try {
            $course = Course::findOrFail($id);
            $course->isDeleted = false;
            $course->save();
            
            if ($course->courseType->type == "Course") {
                $message = 'Online Course (' . $course->title . ') has been un-archived.';
            } elseif ($course->courseType->type == "Woki") {
                $message = 'Woki Course (' . $course->title . ') has been un-archived.';
            } elseif ($course->courseType->type == "Bootcamp") {
                $message = 'Bootcamp Course (' . $course->title . ') has been un-archived.';
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
            } elseif ($course->courseType->type == "Bootcamp") {
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
            } elseif ($course->courseType->type == "Bootcamp") {
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

    // Function to set user_course isAbsent status to its opposite value.
    public static function setIsAbsentStatusToOpposite($course_id, $user_id) {
        try {

            $user =  User::findOrFail($user_id);   

            $user_course = $user->courses->where('id',$course_id)->first()->pivot;
            $user_course->isAbsent = !$user_course->isAbsent;
            
            $user_course->save();


            if ($user_course->isAbsent)
                $message = $user->name .' tidak hadir di kelas woki' ;
            else
                $message = $user->name .' hadir hadir di kelas woki' ;

            return [
                'status' => 'Success',
                'data' => $user_course,
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

    // Function to get courses suggestions
    public static function getCourseSuggestion($size, $type = null) {
        $userHashtags = auth()->user()->hashtags()->get()->pluck('hashtag')->toArray();
        $courses = Course::with('hashtags')
            ->where('enrollment_status', 'open')
            ->where('publish_status', 'published')
            ->where('isDeleted', false)->get()
            ->sortByDesc(function ($course) use ($userHashtags) {
                $similarityPoint = 0;
                foreach ($course->hashtags as $hashtag) {
                    if (in_array($hashtag->hashtag, $userHashtags))
                        $similarityPoint++;
                }
                return $similarityPoint;
            });

        if ($type)
            $courses = $courses->filter(function ($course) use ($type) {
                return $course->courseType->type == $type;
            });

        return $courses->filter(fn($course) => !CourseHelper::hasUserBoughtCourse($course))->take($size);
    }

    // Private function to check if user's has bought the course.
    private static function hasUserBoughtCourse($course) {
        foreach (auth()->user()->courses as $userCourse) {
            if ($userCourse->id == $course->id)
                return true;
        }
        return false;
    }
}