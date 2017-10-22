package werd;

public class Video{

  String ID;
  int startTime;
  int endTime;

  public Video(String id){
    this.ID = id;
    this.startTime = 0;
  }

  public Video(String id, int start, int end){
    this.ID = id;
    this.startTime = start;
    this.endTime = end;
  }

  public String getID(){
    return ID;
  }

  public int getStartTime(){
    return startTime;
  }

  public int getEndTime(){
    return endTime;
  }

}
