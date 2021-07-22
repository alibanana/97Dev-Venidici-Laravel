<?php

namespace App\Helper;

use Exception;

use App\Models\Course;
use App\Models\SectionContent;
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

    // Update course's publish status.
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

    public static function isCourseSectionContentEmpty($course_id) {
        $course = Course::findOrFail($course_id);
        if ($course->sections->isEmpty())
            return true;
        foreach ($course->sections as $section) {
            if ($section->sectionContents->isEmpty())
                return true;
            foreach ($section->sectionContents as $content) {
                if ($content->title == null || $content->youtube_link == null || $content->duration == null)
                    return true;
            }
        }
        return false;
    }

    // Update the course's total_duration.
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

    // Function to get live workshop courses in dashboard page. (with pagination)
    public static function getDashboardLiveCoursesDataWithPagination($amountPerPage, $page) {
        $liveCoursesData = auth()->user()->courses()->where('course_type_id', '!=', 1)->get()->filter(function ($course) {
            return $course->pivot->status == 'on-going';
        })->chunk($amountPerPage);
        
        if ($liveCoursesData->isEmpty()) 
            return ['data' => null];

        $totalPageAmount = $liveCoursesData->count();
        $isNumberOfPageExceedTotalPageAmount = $page > $totalPageAmount;
        $isFirstPage = $page == 1;
        $isLastPage = $page == $totalPageAmount;
        return [
            'data' => $isNumberOfPageExceedTotalPageAmount ? $liveCoursesData[0] : $liveCoursesData[$page - 1],
            'total_page_amount' => $totalPageAmount,
            'current_page' => $isNumberOfPageExceedTotalPageAmount ? 1 : $page,
            'previous_page' => $isFirstPage ? $page : $page - 1,
            'next_page' => $isLastPage || $isNumberOfPageExceedTotalPageAmount ? $page : $page + 1
        ]; 
    }

    // Function to get skill on-going courses in dashboard page. (with pagination)
    public static function getDashboardOnGoingCoursesDataWithPagination($amountPerPage, $page) {
        $onGoingCoursesData = auth()->user()->courses()->where('course_type_id', 1)->get()->filter(function ($course) {
            return $course->pivot->status == 'on-going';
        })->chunk($amountPerPage);
        
        if ($onGoingCoursesData->isEmpty()) 
            return ['data' => null];

        $totalPageAmount = $onGoingCoursesData->count();
        $isNumberOfPageExceedTotalPageAmount = $page > $totalPageAmount;
        $isFirstPage = $page == 1;
        $isLastPage = $page == $totalPageAmount;

        return [
            'data' => $isNumberOfPageExceedTotalPageAmount ? $onGoingCoursesData[0] : $onGoingCoursesData[$page - 1],
            'total_page_amount' => $totalPageAmount,
            'current_page' => $isNumberOfPageExceedTotalPageAmount ? 1 : $page,
            'previous_page' => $isFirstPage ? $page : $page - 1,
            'next_page' => $isLastPage || $isNumberOfPageExceedTotalPageAmount ? $page : $page + 1
        ]; 
    }

    // Function to get completed course in dashboard page. (with pagination)
    public static function getDashboardCompletedCoursesDataWithPagination($amountPerPage, $page) {
        $completedCoursesData = auth()->user()->courses()->get()->filter(function ($course) {
            return $course->pivot->status == 'completed';
        })->chunk($amountPerPage);

        if ($completedCoursesData->isEmpty()) 
            return ['data' => null];

        $totalPageAmount = $completedCoursesData->count();
        $isNumberOfPageExceedTotalPageAmount = $page > $totalPageAmount;
        $isFirstPage = $page == 1;
        $isLastPage = $page == $totalPageAmount;

        return [
            'data' => $isNumberOfPageExceedTotalPageAmount ? $completedCoursesData[0] : $completedCoursesData[$page - 1],
            'total_page_amount' => $totalPageAmount,
            'current_page' => $isNumberOfPageExceedTotalPageAmount ? 1 : $page,
            'previous_page' => $isFirstPage ? $page : $page - 1,
            'next_page' => $isLastPage || $isNumberOfPageExceedTotalPageAmount ? $page : $page + 1
        ]; 
    }

    // Calculate user's online-course progress in percentage.
    public static function calculateUserOnlineCoursesProgress() {
        $onGoingCourses = auth()->user()->courses()->where('course_type_id', 1)->get()->filter(function ($course) {
            return $course->pivot->status == 'on-going';
        });

        $userCourseProgressByCourseIds = [];
        foreach ($onGoingCourses as $course) {
            $userCourseProgressByCourseIds[$course->id] = CourseHelper::calculateUserCourseProgressByCourseObject($course);
        }

        return $userCourseProgressByCourseIds;
    }

    // Calculate user's online-course progress for a specific course by course object.
    public static function calculateUserCourseProgressByCourseObject($course) {
        $totalNumberOfContents = 0; $contentsWatched = 0;
        foreach ($course->sections as $section) {
            $totalNumberOfContents += $section->sectionContents->count();
            foreach ($section->sectionContents as $content) {
                $contentUserIds = explode(',', $content->hasSeen);
                if (in_array(auth()->user()->id, $contentUserIds))
                    $contentsWatched++;
            }
        }
        return round(($contentsWatched / $totalNumberOfContents) * 100);
    }

    // Get courses suggestions
    public static function getCourseSuggestion($size, $type = null) {
        $userHashtags = auth()->user()->hashtags()->get()->pluck('hashtag')->toArray();
        $courses = Course::with('hashtags')->get()->sortByDesc(function ($course) use ($userHashtags) {
            $similarityPoint = 0;
            foreach ($course->hashtags as $hashtag) {
                if (in_array($hashtag->hashtag, $userHashtags))
                    $similarityPoint++;
            }
            return $similarityPoint;
        });

        if ($type) {
            $courses = $courses->filter(function ($course) use ($type) {
                return $course->courseType->type == $type;
            });
        }

        return $courses->filter(function ($course) {
            return !CourseHelper::hasUserBoughtCourse($course);
        })->take($size);
    }

    // Private function to check if user's has bought the course.
    private static function hasUserBoughtCourse($course) {
        foreach (auth()->user()->courses as $userCourse) {
            if ($userCourse->id == $course->id)
                return true;
        }
        return false;
    }

    // Get validated (user has bought) course object by its title.
    public static function getUserValidatedCourseByTitle($course_title) {
        return auth()->user()->courses()->where('title', $course_title)->firstOrFail();
    }

    // Get sectionContent by course_id & content_title.
    public static function getSectionContentByCourseIdAndTitle($course_id, $title) {
        $content = SectionContent::where('title', $title)->get()->filter(function ($content) use ($course_id) {
            return $content->section->course_id == $course_id;
        })->take(1);
        return $content->isEmpty() ? null : $content->first();
    }

    // Check if content's title is unique in course level.
    public static function isSectionContentTitleUniqueByCourseObjectAndTitle($course, $title) {
        foreach ($course->sections as $section) {
            if ($section->sectionContents()->where('title', $title)->first())
                return false;
        }
        return true;
    }
}