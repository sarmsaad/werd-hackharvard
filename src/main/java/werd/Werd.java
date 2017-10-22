package werd;

import com.mongodb.MongoClient;
import com.mongodb.MongoClientURI;
import com.mongodb.ServerAddress;

import com.mongodb.client.MongoDatabase;
import com.mongodb.client.MongoCollection;

import org.bson.Document;
import java.util.Arrays;
import com.mongodb.Block;
import com.mongodb.BasicDBList;

import com.mongodb.client.MongoCursor;
import static com.mongodb.client.model.Filters.*;
import com.mongodb.client.result.DeleteResult;
import static com.mongodb.client.model.Updates.*;
import com.mongodb.client.result.UpdateResult;
import java.util.ArrayList;
import java.util.List;
import java.util.Random;
import com.fasterxml.jackson.databind.ObjectMapper;

public class Werd{

    public String word;
    public int number;
    public Video video1;
    public Video video2;
    public Video video3;
    public Video video4;
    public Video video5;


    public Werd(String word){
      this.word = word;
      this.number = 0;
      this.results();
    }

    public String getWord(){
      return word;
    }

    public int getNumber(){
      return number;
    }

    public void results(){
      MongoClientURI connectionString = new MongoClientURI("mongodb://ec2-34-207-92-4.compute-1.amazonaws.com:27019");
      MongoClient mongoClient = new MongoClient(connectionString);
      MongoDatabase database = mongoClient.getDatabase("word");
      MongoCollection<Document> words = database.getCollection("words");
      MongoCollection<Document> sentences = database.getCollection("sen"); //sskdhfkjdsh:90 sdfhjkjsdfh:21 of the collection
      Document myDoc = words.find(eq("_id",word)).first();
      String[] setID = myDoc.getString("senId").split(","); //lfkhgfhg:87 wejhwejkhr:90 style of the searched word
      String[] videoID = myDoc.getString("videoId").split(",");
      int lenTimes = setID.length; //the number of timestamps
      int lenVideos = videoID.length; //the number we can use of different videos
      String[] alreadyUsed = new String[5];
      int len = videoID.length;

      if(len > 0){
        video1 = generate(setID,alreadyUsed,sentences,lenTimes,number);
        number++;
        len--;
        alreadyUsed[0] = video1.ID;
        if(len>0){
          video2 = generate(setID,alreadyUsed,sentences,lenTimes,number);
          number++;
          len--;
          alreadyUsed[1] = video2.ID;
          if(len>0){
            video3 = generate(setID,alreadyUsed,sentences,lenTimes,number);
            number++;
            len--;
            alreadyUsed[2] = video3.ID;
            if(len>0){
              video4 = generate(setID,alreadyUsed,sentences,lenTimes,number);
              number++;
              len--;
              alreadyUsed[3] = video4.ID;
              if(len>0){
                video5 = generate(setID,alreadyUsed,sentences,lenTimes,number);
                number++;
                len--;
                alreadyUsed[4] = video5.ID;
              }
            }
          }
        }
      }
    }

    public Video generate(String[] setID, String[] usedVideos, MongoCollection<Document> sentences, int lenTimes, int lengthOFusedVideosAlready){
      boolean notUsed = true;
      int rand=0;
      Random r = new Random();
      //keep looping until finding a random index of a video timestamp where we didnt use the videoID before
      while(notUsed){
        rand = r.nextInt(lenTimes);
        notUsed = this.usedBefore(usedVideos, setID[rand], lengthOFusedVideosAlready);
      }
      //once we select a random define a new video instance
      String[] togetvidID = setID[rand].split(":");
      String vidID = togetvidID[0];
      Document searchTime = sentences.find(eq("_id", setID[rand])).first();
      String start = searchTime.getString("start");
      String end = searchTime.getString("end");
      return new Video(vidID, toSecond(start), toSecond(end));
    }

    //return a timestamp of hh:mm:ss.000 into seconds only
    public int toSecond(String time){
      String[] arr = time.split(":");
      int hour = Integer.parseInt(arr[0]);
      int minut = Integer.parseInt(arr[1]) + hour * 60;
      int sec = Integer.parseInt(arr[2].substring(0, 2)) + minut * 60;
      return sec;
    }

    //return whether or not a selected video timestamp has been declared before or not
    //returns true for using it before
    public boolean usedBefore(String[] usedVideos, String videoToUse, int length){
      String[] togetvidID = videoToUse.split(":");
      String vidID = togetvidID[0];
      for(int i = 0; i < length; i++){
        if(vidID.equals(usedVideos[i])){
          return true;
        }
      }
      return false;
    }

}
