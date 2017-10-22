package werd;

public class Video{

  String videoID;
  int startTime;
  int endTime;

  public Video(String id){
    this.videoID = id;
    this.startTime = 0;
    this.endTime = null;
  }

  public Video(String id, int start, String end){
    this.videoID = id;
    this.startTime = start;
    this.endTime = end;
  }

  public String getVideoID(){
    return videoID;
  }

  public int getStartTime(){
    return startTime;
  }

  public int getEndTime(){
    return endTime;
  }

}
