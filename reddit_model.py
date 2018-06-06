from __future__ import print_function
from pyspark import SparkConf, SparkContext
from pyspark.sql import SQLContext
from pyspark.ml.feature import CountVectorizer

# IMPORT OTHER MODULES HERE
from cleantext import sanitize
from pyspark.sql.functions import udf
from pyspark.sql.types import ArrayType, StringType, IntegerType


def main(context):
    """Main function takes a Spark SQL context."""
    # YOUR CODE HERE
    # YOU MAY ADD OTHER FUNCTIONS AS NEEDED


def str_to_tokens(comments):
    res_str = ""
    # sanitized_token_list = sanitize(comments)
    for token_str in comments:
        res_str = res_str + ' ' + token_str
    return res_str.split()


def choose_label_pos(_type):
    return 1 if _type == 1 else 0


def choose_label_neg(_type):
    return 1 if _type == -1 else 0


if __name__ == "__main__":
    conf = SparkConf().setAppName("CS143 Project 2B")
    conf = conf.setMaster("local[*]")
    sc = SparkContext(conf=conf)
    sqlContext = SQLContext(sc)
    sc.addPyFile("cleantext.py")

    # Task 1
    # comments = sqlContext.read.json("comments-minimal.json")    # data_frame for comments
    # submissions = sqlContext.read.json("submissions.json")        # data_frame for submissions
    # labeled_data = sqlContext.read.load("labeled_data.csv", format="csv", sep=",", inferSchema="true", header="true")

    # comments.write.parquet("comments.parquet")
    # submissions.write.parquet("submissions.parquet")
    # labeled_data.write.parquet("labeled_data.parquet")

    comments = sqlContext.read.parquet("comments.parquet")
    submissions = sqlContext.read.parquet("submissions.parquet")
    labeled_data = sqlContext.read.parquet("labeled_data.parquet")
    # comments.show()
    # print('*' * 50)
    # submissions.show()

    # Task 2
    '''
    comments.createOrReplaceTempView("comments_view")           # Register the df as a SQL temporary view
    submissions.createOrReplaceTempView("submissions_view")
    labeled_data.createOrReplaceTempView("labeled_data_view")

    # labelded_comments = sqlContext.sql("  SELECT id, body, labeldem, labelgop, labeldjt FROM comments_view, labeled_data_view WHERE id = Input_id LIMIT 10")
    labelded_comments = sqlContext.sql("SELECT id, body, labeldjt FROM comments_view, labeled_data_view WHERE id = Input_id")
    # labelded_comments.show()
    # labelded_comments.printSchema()

    # comments_arr = labelded_comments.select("body").rdd.flatMap(lambda x: x).collect()
    # grams = []
    # for i in range(len(comments_arr)):
    #     return_list = []
    #     sanitized_token_list = sanitize(comments_arr[i])
    #     for token_str in sanitized_token_list:
    #         lst = token_str.split()
    #         return_list+= lst
    #     grams.append(return_list)

    # Task 4
    # sqlContext.udf.register("grams", str_to_tokens, StringType())
    udfValueToGrams = udf(sanitize, ArrayType(StringType()))
    labelded_comments = labelded_comments.withColumn("grams", udfValueToGrams("body"))
    labelded_comments.show()

    # # Task 5
    udfGramsToToken = udf(str_to_tokens, ArrayType(StringType()))
    labelded_comments = labelded_comments.withColumn("tokens", udfGramsToToken("grams"))
    labelded_comments.show()

    # Task 6 A
    cv = CountVectorizer(inputCol='tokens', outputCol='features', binary=True, minDF=5)

    model = cv.fit(labelded_comments)
    result = model.transform(labelded_comments)

    result.show()

    # Task 6 B
    udfpos = udf(choose_label_pos, IntegerType())
    result = result.withColumn("pos", udfpos("labeldjt"))

    udfneg = udf(choose_label_neg, IntegerType())
    result = result.withColumn("neg", udfneg("labeldjt"))

    result.show()

    # Task 7
    pos = result.drop('id', 'body', 'labeldjt', 'grams', 'tokens', 'neg')
    neg = result.drop('id', 'body', 'labeldjt', 'grams', 'tokens', 'pos')
    pos = pos.toDF('features', 'label')
    neg = neg.toDF('features', 'label')
    # pospos.withColumnRenamed("features", "pos").withColumnRenamed("features", "label")
    # neg.withColumnRenamed("features", "neg").withColumnRenamed("features", "label")
    pos.show()
    neg.show()
    # Bunch of imports (may need more)
    from pyspark.ml.classification import LogisticRegression
    from pyspark.ml.tuning import CrossValidator, ParamGridBuilder
    from pyspark.ml.evaluation import BinaryClassificationEvaluator
    # Initialize two logistic regression models.
    # Replace labelCol with the column containing the label, and featuresCol with the column containing the features.
    poslr = LogisticRegression(labelCol="label", featuresCol="features", maxIter=10)
    neglr = LogisticRegression(labelCol="label", featuresCol="features", maxIter=10)
    # This is a binary classifier so we need an evaluator that knows how to deal with binary classifiers.
    posEvaluator = BinaryClassificationEvaluator()
    negEvaluator = BinaryClassificationEvaluator()
    # There are a few parameters associated with logistic regression. We do not know what they are a priori.
    # We do a grid search to find the best parameters. We can replace [1.0] with a list of values to try.
    # We will assume the parameter is 1.0. Grid search takes forever.
    posParamGrid = ParamGridBuilder().addGrid(poslr.regParam, [1.0]).build()
    negParamGrid = ParamGridBuilder().addGrid(neglr.regParam, [1.0]).build()
    # We initialize a 5 fold cross-validation pipeline.
    posCrossval = CrossValidator(
        estimator=poslr,
        evaluator=posEvaluator,
        estimatorParamMaps=posParamGrid,
        numFolds=5)
    negCrossval = CrossValidator(
        estimator=neglr,
        evaluator=negEvaluator,
        estimatorParamMaps=negParamGrid,
        numFolds=5)
    # Although crossvalidation creates its own train/test sets for
    # tuning, we still need a labeled test set, because it is not
    # accessible from the crossvalidator (argh!)
    # Split the data 50/50
    posTrain, posTest = pos.randomSplit([0.5, 0.5])
    negTrain, negTest = neg.randomSplit([0.5, 0.5])
    # Train the models
    print("Training positive classifier...")
    posModel = posCrossval.fit(posTrain)
    print("Training negative classifier...")
    negModel = negCrossval.fit(negTrain)

    # Once we train the models, we don't want to do it again. We can save the models and load them again later.
    posModel.save("www/pos.model")
    negModel.save("www/neg.model")
    '''

    
