package werd;

import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;

@RestController
public class WerdController{

    @RequestMapping("/werd")
    public Werd returnSearch(@RequestParam(value = "word") String word){
      return new Werd(word);
    }
}
